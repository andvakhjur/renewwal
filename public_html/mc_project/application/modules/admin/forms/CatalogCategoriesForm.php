<?php

class Admin_Form_CatalogCategoriesForm extends Mc_Form
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
        //####################################################################//
        
        
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
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'img';
        $articlesModel = new Admin_Model_CatalogCategoriesModel();
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
                    'width' => '2000',
                    'height' => '2000',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
                array(
                    'targetDir' => 'ss_',
                    'width' => '400',
                    'height' => '400',
                    'cut' => 1,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
            ),
        );
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_ImageUpload($elementName, $this->_options[$elementName], $this);
        $this->groups[$groupName][$elementName]->setLabel('Картинка: ');
        //--------------------------------------------------------------------//
        $elementName = 'txt';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Текст: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
        $this->groups[$groupName][$elementName]->addDecorator('Tinymce', array(
            'type' => 'Standart',
        ));
        //--------------------------------------------------------------------//
        $elementName = 'stxt';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Краткий текст: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
        $this->groups[$groupName][$elementName]->addDecorator('Tinymce', array(
            'type' => 'Standart',
        ));
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
        $elementName = 'url';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('URL страницы: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->addValidator(new Mc_Validate_ArticleExists(array(
            'modelName' => 'Admin_Model_CatalogCategoriesModel',
            'colName' => $elementName,
            'id' => $this->_options['formValues']['id'],
        )));
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
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

        if(empty($return['url']) && $this->getElement('url')) {
            $catalogCategories = new Admin_Model_CatalogCategoriesModel();
            $return['url'] = $catalogCategories->getUrlName($return['title']);
            //$return['url'] = Mc_Functions::strUrlTranslite($return['title']);
        }

        unset($return['title_label']);
        
        unset($return['submit']);
        unset($return['cancel']);

        return $return;
    }
}
