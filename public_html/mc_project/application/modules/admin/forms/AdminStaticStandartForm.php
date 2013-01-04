<?php

class Admin_Form_AdminStaticStandartForm extends Mc_Form
{

    public $groups = array();

    public function init()
    {
        parent::init();

        $this->setMethod('post');
        $helperUrl = new Zend_View_Helper_Url();
        
        if (true == Zend_Registry::get('view')->itsAdmin) {
            $this->setAction($helperUrl->url(array('module' => Zend_Registry::get('view')->moduleName, 'controller' => Zend_Registry::get('view')->controllerName, 'action' => Zend_Registry::get('view')->actionName, 'admin'=>'yes'), 'default', true));
        } else {
            $this->setAction($helperUrl->url(array(), Zend_Registry::get('view')->routeName, true));
        }

        $groupNumb = 0;
        $elementNumb = 0;
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        if (true == Zend_Registry::get('view')->itsAdmin) {
            $elementName = 'url';
            $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
            $this->groups[$groupName][$elementName]->setLabel('url: ');
            //$this->groups[$groupName][$elementName]->setRequired(true);
            $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        }
        //--------------------------------------------------------------------//
        $elementName = 'title';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Заголовок: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'txt';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Текст: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->addDecorator('Tinymce', array('type' => 'Standart'));
        $this->groups[$groupName][$elementName]->setAttrib('cols', 80);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 40);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_seo_toggle';
        //--------------------------------------------------------------------//
        $elementName = 'title_label';
        ob_start();?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#group_seo-label').toggle();
                $('#group_seo-element').toggle();
            });
        </script>
        <script type="text/javascript">
            function seoToggle()
            {
                $('#group_seo-label').toggle();
                $('#group_seo-element').toggle();
            }
        </script>
        <a class="not_open_link" href="javascript: void(0);" onClick="javascript: seoToggle();">
            Дополнительно
        </a>
        <?php $html = ob_get_contents();ob_end_clean();
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_Html($elementName, array(
            "html" => $html,
        ));
        $this->groups[$groupName][$elementName]->setLabel('');
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_seo';
        //--------------------------------------------------------------------//
        $elementName = 'meta_title';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('meta_title: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'meta_description';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('meta_description: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
        //--------------------------------------------------------------------//
        $elementName = 'meta_keywords';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('meta_keywords: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
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

        unset($return['title_label']);

        unset($return['submit']);
        unset($return['cancel']);

        return $return;
    }
}
