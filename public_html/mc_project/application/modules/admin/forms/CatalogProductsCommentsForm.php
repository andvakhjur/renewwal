<?php

class Admin_Form_CatalogProductsCommentsForm extends Mc_Form
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
        $elementName = 'datetime';
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_Datetime($elementName);
        $this->groups[$groupName][$elementName]->setRequired(false);
        $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Date(array('dd.MM.YYYY HH:mm:ss')), true);
        $this->groups[$groupName][$elementName]->addFilter(new Zend_Filter_StringTrim());
        $this->groups[$groupName][$elementName]->addDecorator('DateTimepicker');
        $this->groups[$groupName][$elementName]->setLabel('Время публикации: ');
        //--------------------------------------------------------------------//
        $elementName = 'show';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Показывать: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //$this->groups[$groupName][$elementName]->setAttrib('size', 40);
        $this->groups[$groupName][$elementName]->addMultiOptions(array(
            'show' => 'да',
            'hide' => 'нет',
            'mod' => 'на модерации',
        ));
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'prod_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Товар: ');
        $this->groups[$groupName][$elementName]->setRegisterInArrayValidator(false);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogProductsModel();
        $opt = $opt->getArticles(array());
        
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        //--------------------------------------------------------------------//
        $elementName = 'user_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Пользователь: ');
        $this->groups[$groupName][$elementName]->setRegisterInArrayValidator(false);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_AdminUsersModel();
        $opt = $opt->getArticles(array());
        
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['login'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        //--------------------------------------------------------------------//
        $elementName = 'order';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Порядок: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'title';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Название: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
        //--------------------------------------------------------------------//
        $elementName = 'txt';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Текст: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
//        $this->groups[$groupName][$elementName]->addDecorator('Tinymce', array(
//            'type' => 'Standart',
//        ));
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

        if(empty($return['url']) && $this->getElement('url')) {
            $catalogProductsColors = new Admin_Model_CatalogProductsColorsModel();
            $return['url'] = $catalogProductsColors->getUrlName($return['title']);
            //$return['url'] = Mc_Functions::strUrlTranslite($return['title']);
        }
        
        unset($return['title_label']);

        unset($return['submit']);
        unset($return['cancel']);

        return $return;
    }
}
