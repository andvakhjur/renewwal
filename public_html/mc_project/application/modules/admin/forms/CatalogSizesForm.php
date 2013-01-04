<?php

class Admin_Form_CatalogSizesForm extends Mc_Form
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
        $elementName = 'title';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Название: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'order';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Порядок: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
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
        //$values = $this->getValues();
        //$datetime = new Zend_Date($values['datetime']);
        //$return['datetime'] = $datetime->toString('yyyy-MM-dd HH:mm:ss');

//        if(empty($return['url']) && $this->getElement('url')) {
//            $catalogSizes = new Admin_Model_CatalogSizesModel();
//            $return['url'] = $catalogSizes->getUrlName($return['title']);
//            //$return['url'] = Mc_Functions::strUrlTranslite($return['title']);
//        }
        
        unset($return['title_label']);

        unset($return['submit']);
        unset($return['cancel']);

        return $return;
    }
}
