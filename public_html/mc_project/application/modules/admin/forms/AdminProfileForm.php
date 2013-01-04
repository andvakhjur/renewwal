<?php

class Admin_Form_AdminProfileForm extends Mc_Form
{

    public $groups = array();

    public function init()
    {
        parent::init();

        $this->setMethod('post');
        $helperUrl = new Zend_View_Helper_Url();
        $this->setAction($helperUrl->url(array('module' => Zend_Registry::get('view')->moduleName, 'controller' => Zend_Registry::get('view')->controllerName, 'action' => Zend_Registry::get('view')->actionName), 'default', true));

        $groupNumb = 0;
        $elementNumb = 0;

        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'login';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Логин: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'password';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Password($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Пароль: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'fio';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Имя: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'status';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Статус: ');
        //$this->groups[$groupName][$elementName]('text', 'status')->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'avatar';
        $articlesModel = new Admin_Model_AdminUsersModel();
        // получаем данные из таблицы
        $front = Zend_Controller_Front::getInstance();
        $id = $front->getRequest()->getParam('id', null);
        if (null != $id) {
            $values = $articlesModel->getArticle($id);
        }
        
        $this->_options[$elementName] = array(
            'fileUrl' => $articlesModel->getUrlUpload() . '/images',
            'filePath' => $articlesModel->getPathUpload() . '/images',
            'fileName' => $values[$elementName],
            'groupName' => $groupName,
            'previewPrefix' => array(
                'small' => 'adm_',
                'big' => 's_',
            ),
            'sizes' => array(
                array(
                    'targetDir' => 'adm_',
                    'width' => '100',
                    'height' => '100',
                    'cut' => 1,
                    'leaveTop' => 1, // 1 - оставляем верх, 0 - оставляем середину (актуально только при cut=1)
                    'extend' => 0, // 1 - даже если картинка меньше, всё-равно натягиваем её на нужный размер
                ),
                array(
                    'targetDir' => 's_',
                    'width' => '800',
                    'height' => '800',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
            ),
        );
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_ImageUpload($elementName, $this->_options[$elementName], $this);
        $this->groups[$groupName][$elementName]->setLabel('Картинка: ');
        //####################################################################//
        
        
        //####################################################################//
        // Buttons
        $groupName = 'buttons';
        //--------------------------------------------------------------------//
        $elementName = 'id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Hidden($elementName);
        $this->groups[$groupName][$elementName]->removeDecorator('label');
        $this->groups[$groupName][$elementName]->removeDecorator('HtmlTag');
        //--------------------------------------------------------------------//
        $elementName = 'submit';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Submit($elementName, array(
                'label' => 'Сохранить',
                'class' => 'save_but'
            ));
        $this->groups[$groupName][$elementName]->clearDecorators();
        $this->groups[$groupName][$elementName]->addDecorator('ViewHelper');
        //--------------------------------------------------------------------//
        $elementName = 'cancel';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Submit($elementName, array(
                'label' => 'Отменить',
                'class' => 'cancel_but'
            ));
        $this->groups[$groupName][$elementName]->clearDecorators();
        $this->groups[$groupName][$elementName]->addDecorator('ViewHelper');
        //####################################################################//
        
        
        //####################################################################//
        // Добавляем группы к форме
        //####################################################################//

        if (count($this->groups) > 0) {
            foreach ($this->groups as $key => $item) {
                switch ($key) {
                    case 'buttons':
                        $this->addDisplayGroup($item, $key, array('class' => 'form_group_buttons'));
                        break;
                    default:
                        $this->addDisplayGroup($item, $key, array('class' => 'form_group'));
                        break;
                }
            }
        }
    }

    /**
     * преобразует POST в нужный для сохранения формат
     */
    public function mapForm()
    {
        // маппим элементы в зависимости от их типа
        $return = parent::mapForm();

        // маппим конкретные элементы
        $values = $this->getValues();
        $return['password'] = sha1($values['password'] . 'ex44ut');
        
        //$last_visit = new Zend_Date($values['last_visit']);
        //$return['last_visit'] = $last_visit->toString('yyyy-MM-dd HH:mm:ss');

        unset($return['title_label']);

        unset($return['submit']);
        unset($return['cancel']);
        
        return $return;
    }
}
