<?php

class Admin_Form_Filter_AdminExampleFilter extends Mc_Form_Filter
{
    public $groups = array();
    
    public function init()
    {
        parent::init();

        $this->setMethod('post');
        $helperUrl = new Zend_View_Helper_Url();
        $this->setAction($helperUrl->url(array('module' => Zend_Registry::get('view')->moduleName, 'controller' => Zend_Registry::get('view')->controllerName, 'action' => 'index'), 'default', true));
        
        $groupNumb = 0;
        $elementNumb = 0;
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'sect_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Раздел:</dt><dd>'));
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //$this->groups[$groupName][$elementName]->setAttrib('size', 40);
        $options = array();
        $options[''] = 'все';
        $opt = new Admin_Model_AdminExampleModel();
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
            'firstSelectId' => 'filter_sect_id',
            'secondSelectId' => 'filter_cat_id',
            'secondSelectModelName' => 'Admin_Model_AdminExampleModel',
            'secondSelectColNamePar' => 'sect_id',
            'secondSelectColNameId' => 'id',
            'secondSelectColNameTitle' => 'title',

        )));
        //--------------------------------------------------------------------//
        $elementName = 'cat_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Категория:</dt><dd>'));
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //$this->groups[$groupName][$elementName]->setAttrib('size', 40);
        $options = array();
        $options[''] = 'все';
        $opt = new Admin_Model_AdminExampleModel();
        $opt = $opt->getArticles();
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->groups[$groupName][$elementName]->addMultiOptions(
            $options
        );
        //--------------------------------------------------------------------//
        $elementName = 'date_from';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->setAttrib('size', 10);
        $this->groups[$groupName][$elementName]->setAttrib('maxlength', 10);
        $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Date(array('dd.MM.yyyy')), true);
        $this->groups[$groupName][$elementName]->addFilter(new Zend_Filter_StringTrim());
        $this->groups[$groupName][$elementName]->clearDecorators();
        $this->groups[$groupName][$elementName]->addDecorator('ViewHelper');
        $this->groups[$groupName][$elementName]->addDecorator('Datepicker');
        $this->groups[$groupName][$elementName]->addDecorator('Errors');
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Дата c:</dt><dd>'));
        //--------------------------------------------------------------------//
        $elementName = 'date_to';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->setAttrib('size', 10);
        $this->groups[$groupName][$elementName]->setAttrib('maxlength', 10);
        $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Date(array('dd.MM.yyyy')), true);
        $this->groups[$groupName][$elementName]->addFilter(new Zend_Filter_StringTrim());
        $this->groups[$groupName][$elementName]->clearDecorators();
        $this->groups[$groupName][$elementName]->addDecorator('ViewHelper');
        $this->groups[$groupName][$elementName]->addDecorator('Datepicker');
        $this->groups[$groupName][$elementName]->addDecorator('Errors');
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Дата по:</dt><dd>'));
        //--------------------------------------------------------------------//
        $elementName = 'show';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Показывать:</dt><dd>'));
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //$this->groups[$groupName][$elementName]->setAttrib('size', 40);
        $this->groups[$groupName][$elementName]->addMultiOptions(array(
            '' => 'все',
            'show' => 'да',
            'hide' => 'нет',
            'mod' => 'на модерации',
            'del' => 'удалено',
        ));
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'title';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Название:</dt><dd>'));
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //--------------------------------------------------------------------//
        $elementName = 'txt';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setAttrib('id', 'filter_' . $this->groups[$groupName][$elementName]->getName());
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => '<dt>Текст:</dt><dd>'));
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //--------------------------------------------------------------------//
        $elementName = 'filter_submit';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Submit($elementName, array(
            'label' => 'Найти',
            //'class' => 'save_but',
            'style' => 'cursor:pointer',
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
                    default:
                        $this->addDisplayGroup($item, $key,
                            array(
                                'decorators' => array(
                                    'FormElements',
                                    array('HtmlTag', array('tag' => 'div', 'class' => 'element')),
                                ),
                            )
                        );
                        break;
                }
            }
        }
    }
    
    public function mapFilter($data)
    {
        $filterValues = array();
        
        if (count($this->getElements()) > 0) {
            foreach ($this->getElements() as $key => $item) {
                if (!empty($data[$key])) {

                    switch ($key) {
                        case 'submit':
                            break;
                        case 'filter_date_from':
                        case 'filter_date_to':
                            $filterValues[$key] = $data[$key];
                            $this->getElement($key)->setValue(date('d.m.Y', strtotime($data[$key])));
                            break;
                        default:
                            $filterValues[$key] = $data[$key];
                            $this->getElement($key)->setValue($data[$key]);
                            break;
                    }
                }
            }
        }
        
        return $filterValues;
    }
}