<?php

class Admin_CartOrdersProductsController extends Mc_Controller_Action
{

    protected $_articlesModel;
    protected $_filterForm;
    protected $_sessionNamespace;
    protected $_filterValues;
    protected $_filterSql;
    protected $_breadcrumbs;
    protected $_title;

    public function init()
    {
        parent::init();

        $this->_layout->setLayout('layout');
        $this->_sessionNamespace = new Zend_Session_Namespace('admin-' . $this->_controllerName);
        
        $this->_articlesModel = new Admin_Model_CartOrdersProductsModel();
        $this->_filterForm = $this->_articlesModel->getFormFilter();
        $this->view->filterForm = $this->_filterForm;
        $this->_filterValues = $this->_filterForm->mapFilterFromSession($this->_sessionNamespace);
        
        $this->view->urlUpload = $this->_articlesModel->getUrlUpload();// url для сохранения файлов
        $this->view->pathUpload = $this->_articlesModel->getPathUpload();// path для сохранения файлов
        
        $this->_breadcrumbs->addCrumb(Admin_Model_CartOrdersModel::getCrumb());
        $this->_breadcrumbs->addCrumb(Admin_Model_CartOrdersProductsModel::getCrumb());
    }

    public function indexAction()
    {
        if ($this->_hasParam('filter_submit') && $this->getRequest()->isPost()) {
            if ($this->_filterForm->isValid($this->_getAllParams())) {
                $this->_filterValues = $this->_filterForm->mapFilterFromPost($this->_sessionNamespace, array(
                    "values" => $this->_filterForm->getValues(),
                ));
            } else {
                $this->_filterValues = $this->_filterForm->mapFilterFromSession($this->_sessionNamespace);
            }
        } else {
            $this->_filterValues = $this->_filterForm->mapFilterFromSession($this->_sessionNamespace);
        }
        
        $this->_filterSql = $this->_articlesModel->getfilterSql($this->_filterValues);
        
        if (count($this->_sessionNamespace->orderValues) > 0) {
            $orderArr = array();
            foreach ($this->_sessionNamespace->orderValues as $key => $item) {
                $direction = strtoupper($item->direction);
                $orderArr[] = "{$key} {$direction}";
            }
            $order = implode(', ', $orderArr);
            $this->view->orderValues = $this->_sessionNamespace->orderValues;
        } else {
            $order = "id DESC";
        }
        $this->view->paginator = $this->_articlesModel->getPaginator(array(
            "page" => $this->_getParam('page'),
            'order' => $order,
            "select" => $this->_filterSql,
        ));

        $this->_layout->content = $this->view->render($this->view->controllerName . '/' . Mc_Functions::strToViewName(str_replace('Action', '', __FUNCTION__)) . '.phtml');
        echo $this->_layout->render();
    }

    public function deleteAction()
    {
        $this->_articlesModel->deleteArticle($this->_getParam('id'));
        $this->_helper->flashMessenger->addMessage('Данные успешно удалены');
        return $this->_helper->redirector('index');
    }

    public function delfieldsAction()
    {
        if ($this->getRequest()->isPost()) {
            if (sizeof($this->_getParam('field')) > 0) {
                $this->_articlesModel->deleteArticles($this->_getParam('field'));
                $this->_helper->flashMessenger->addMessage('Данные успешно удалены');
            }
        }
        return $this->_helper->redirector('index');
    }

    public function addAction()
    {
        $form = $this->_articlesModel->getForm(array(
            "formValues" => $this->_filterValues,
        ));
        // сохраняем данные
        if ($this->getRequest()->isPost()) {
            if (sizeof($this->_getParam('cancel')) == '0') {
                if ($form->isValid($this->_getAllParams())) {// save the content item
                    $this->_articlesModel->addArticle($form->mapForm());
                    $this->_helper->flashMessenger->addMessage('Данные успешно добавлены');
                    return $this->_helper->redirector('index');
                }
            } else {
                $this->_helper->flashMessenger->addMessage('Изменения отменены');
                return $this->_helper->redirector('index');
            }
        }

        // крошки
        $this->_breadcrumbs->addCrumb(array(
            'label' => 'Добавление',
        ));

        // вывод
        $values = $this->_filterValues;
        // последний order
        $values['order'] = $this->_articlesModel->getNextOrder(array());
        $form->makeAddForm(array(
            "formValues" => $values,
        ));
        $this->view->form = $form;
        $this->_layout->content = $this->view->render($this->view->controllerName . '/edit.phtml');
        echo $this->_layout->render();
    }

    public function editAction()
    {
        $id = $this->_getParam('id', NULL);
        $article = $this->_articlesModel->getArticle($id, array());
        
        $form = $this->_articlesModel->getForm(array(
            "formValues" => $article,
        ));

        // сохраняем данные
        if ($this->getRequest()->isPost()) {
            if(null == $id) {
                $id = $this->_getParam('id', NULL);
            }

            if (sizeof($this->_getParam('cancel')) == '0') {
                if ($form->isValid($this->_getAllParams())) {// save the content item
                    $this->_articlesModel->editArticle($form->mapForm(), $id);
                    $this->_helper->flashMessenger->addMessage('Измения успешно сохранены');
                    return $this->_helper->redirector('index');
                }
            } else {
                $this->_helper->flashMessenger->addMessage('Изменения отменены');
                return $this->_helper->redirector('index');
            }
        }

        // крошки
        $this->_breadcrumbs->addCrumb(array(
            'label' => $article['title'],
        ));

        // вывод
        // учитываем значения, которые были отправлены post'ом
        $article = array_merge($article, $this->getRequest()->getPost());
        $form->makeEditForm(array(
            "formValues" => $article
        ));
        $this->view->form = $form;
        $this->_layout->content = $this->view->render($this->view->controllerName . '/' . Mc_Functions::strToViewName(str_replace('Action', '', __FUNCTION__)) . '.phtml');
        echo $this->_layout->render();
    }
    
    /**
     * Чтобы не множить методы, типа filterByParIdAction() и orderByParIdAction(),
     * мы ловим их здесь. Если, потребуется обработать по особому, просто
     * добавляем  в контроллер соответствующий метод и он не попадает в __call()
     * Или смотрим на wiki, если к этому моменту уже будет такая статься
     */
    public function __call($methodName, $args)
    {
        if(preg_match("/filterBy(.*)Action/", $methodName, $matches)) {
            switch($matches[1]) {
                case "SectId":
                case "CatId":
                case "ParId":
                case "OrderId":
                    $colName = Mc_Functions::strToColName($matches[1]);
                    return $this->filterBy($colName);
                    break;
                default:
                    break;
            }
        } elseif(preg_match("/orderBy(.*)Action/", $methodName, $matches)) {
            switch($matches[1]) {
                case "SectId":
                case "CatId":
                case "Datetime":
                case "Title":
                case "Order":
                case "Show":
                case "Url":
                case "OrderId":
                    $colName = Mc_Functions::strToColName($matches[1]);
                    return $this->orderBy($colName);
                    break;
                default:
                    break;
            }
        }
        
        parent::__call($methodName, $args);// зендовская матюкалка на отсутствующий метод
    }
}