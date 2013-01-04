<?php

class Admin_AdminProfileController extends Mc_Controller_Action
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
        
        $this->_articlesModel = new Admin_Model_AdminProfileModel();
        
        $this->_filterForm = $this->_articlesModel->getFormFilter();
        $this->view->filterForm = $this->_filterForm;
        $this->_filterValues = $this->_filterForm->mapFilterFromSession($this->_sessionNamespace);
        
        $this->view->urlUpload = $this->_articlesModel->getUrlUpload();// url для сохранения файлов
        $this->view->pathUpload = $this->_articlesModel->getPathUpload();// path для сохранения файлов
    }
    
    public function editAction()
    {
        $userInfo = Zend_Auth::getInstance()
			->setStorage(new Zend_Auth_Storage_Session('cabinet'))
			->getStorage()
			->read();
        $id = $userInfo->id;
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
            'label' => $article['fio'],
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
}