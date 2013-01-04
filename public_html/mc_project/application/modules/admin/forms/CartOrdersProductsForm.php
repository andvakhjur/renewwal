<?php

class Admin_Form_CartOrdersProductsForm extends Mc_Form {

    public $groups = array();

    public function init() {
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
        $elementName = 'order_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Заказ: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CartOrdersModel();
        $opt = $opt->getArticles(array(
            "order" => "datetime DESC",
        ));
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['datetime'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'sect_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Раздел: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogSectionsModel();
        $opt = $opt->getArticles();
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        $this->groups[$groupName][$elementName]->addDecorator(new Mc_Form_Decorator_SelectAjax(array(
            'firstSelectId' => 'sect_id',
            'secondSelectId' => 'cat_id',
            'secondSelectModelName' => 'Admin_Model_CatalogCategoriesModel',
            'secondSelectColNamePar' => 'sect_id',
            'secondSelectColNameId' => 'id',
            'secondSelectColNameTitle' => 'title',
        )));
        //--------------------------------------------------------------------//
        $elementName = 'cat_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Категория: ');
        $this->groups[$groupName][$elementName]->setRegisterInArrayValidator(false);
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogCategoriesModel();
        if(!empty($this->_options['formValues']['sect_id'])) {
            $opt = $opt->getArticles(array(
                "where" => "`sect_id`={$this->_options['formValues']['sect_id']}",
            ));
        }
        
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        $this->groups[$groupName][$elementName]->addDecorator(new Mc_Form_Decorator_SelectAjax(array(
            'firstSelectId' => 'cat_id',
            'secondSelectId' => 'prod_id',
            'secondSelectModelName' => 'Admin_Model_CatalogProductsModel',
            'secondSelectColNamePar' => 'cat_id',
            'secondSelectColNameId' => 'id',
            'secondSelectColNameTitle' => 'title',
        )));
        //--------------------------------------------------------------------//
        $elementName = 'prod_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Товар: ');
        $this->groups[$groupName][$elementName]->setRegisterInArrayValidator(false);
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogProductsModel();
        if(!empty($this->_options['formValues']['cat_id'])) {
            $opt = $opt->getArticles(array(
                "where" => "`cat_id`={$this->_options['formValues']['cat_id']}",
            ));
        }
        
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'count';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Количество: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
        //--------------------------------------------------------------------//
        $elementName = 'price';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Цена: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
        //--------------------------------------------------------------------//
        $elementName = 'summ';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('В сумме: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
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
    public function mapForm() {
        // маппим элементы в зависимости от их типа
        $return = parent::mapForm();
//        Zend_Debug::dump($return);exit();


        // маппим конкретные элементы
        //$values = $this->getValues();
        //$datetime = new Zend_Date($values['datetime']);
        //$return['datetime'] = $datetime->toString('yyyy-MM-dd HH:mm:ss');
        
        unset($return['sect_id']);
        unset($return['cat_id']);
        
        
        
        unset($return['submit']);
        unset($return['cancel']);

        return $return;
    }
}
