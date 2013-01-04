<?php

class Admin_Form_CatalogProductsForm extends Mc_Form
{

    public $groups = array();
    public $subelements = array();
    
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
        //--------------------------------------------------------------------//
        $elementName = 'brand_id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Бренд: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogBrandsModel();
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
        $elementName = 'order';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Порядок: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'datetime';
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_Datetime($elementName);
        $this->groups[$groupName][$elementName]->setRequired(false);
        $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Date(array('dd.MM.YYYY HH:mm:ss')), true);
        $this->groups[$groupName][$elementName]->addFilter(new Zend_Filter_StringTrim());
        $this->groups[$groupName][$elementName]->addDecorator('DateTimepicker');
        $this->groups[$groupName][$elementName]->setLabel('Время публикации: ');
        //--------------------------------------------------------------------//
        $elementName = 'sale';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Акционный: ');
        $this->groups[$groupName][$elementName]->setMultiOptions(array(
            "no" => "Нет",
            "yes" => "Да",
        ));
        //--------------------------------------------------------------------//
        $elementName = 'show_in_gallery';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Показывать в галерее: ');
        $this->groups[$groupName][$elementName]->setMultiOptions(array(
            "no" => "Нет",
            "yes" => "Да",
        ));
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
        $elementName = 'articul';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Артикул: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
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
        //--------------------------------------------------------------------//
        $elementName = 'price';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Цена: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
        $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Float(array(
            "locale" => "en_US",
        )));
        
         
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'colors';
        $this->_options[$elementName] = array(
            'multielementOptions' => array(
                'modelName' => 'Admin_Model_CatalogProductsColorsModel',
                'parColName' => 'prod_id',
            )
        );
        //---subelement-------------------------------------------------------//
        $subelementName = 'id';
        $this->subelements[$elementName][$subelementName] = new Zend_Form_Element_Hidden($subelementName);
        //$this->subelements[$elementName][$subelementName]->setAttrib('id', '');
        $this->subelements[$elementName][$subelementName]->removeDecorator('label');
        $this->subelements[$elementName][$subelementName]->removeDecorator('HtmlTag');
        //---subelement-------------------------------------------------------//
        $subelementName = 'order';
        $this->subelements[$elementName][$subelementName] = new Zend_Form_Element_Text($subelementName);
        $this->subelements[$elementName][$subelementName]->setLabel('Порядок: ');
        //$this->subelements[$elementName][$subelementName]->setRequired(true);
        $this->subelements[$elementName][$subelementName]->setAttrib('size', 40);
        $this->subelements[$elementName][$subelementName]->setValue('100');
        //---subelement-------------------------------------------------------//
        $subelementName = 'color_id';
        $this->subelements[$elementName][$subelementName] = new Zend_Form_Element_Select($subelementName);
        $this->subelements[$elementName][$subelementName]->setLabel('Цвет: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogColorsModel();
        $opt = $opt->getArticles();
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->subelements[$elementName][$subelementName]->addMultiOptions(
            $options
        );
        
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_MultiElement($elementName, array(
            'elements' => $this->subelements[$elementName],
        ));

        if(($this->_options[$elementName]['multielementOptions']) > 0) {
            $values = array();
            $subarticlesModel = new $this->_options[$elementName]['multielementOptions']['modelName']();
            $subarticlesArticles = $subarticlesModel->getArticles(array(
                'where' => "`{$this->_options[$elementName]['multielementOptions']['parColName']}` = '{$this->_options['formValues']['id']}'",
                'order' => 'order ASC',
            ));
            $this->groups[$groupName][$elementName]->setValue($subarticlesArticles);
        }

        $this->groups[$groupName][$elementName]->setLabel('Цвет: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'sizes';
        $this->_options[$elementName] = array(
            'multielementOptions' => array(
                'modelName' => 'Admin_Model_CatalogProductsSizesModel',
                'parColName' => 'prod_id',
            )
        );
        //---subelement-------------------------------------------------------//
        $subelementName = 'id';
        $this->subelements[$elementName][$subelementName] = new Zend_Form_Element_Hidden($subelementName);
        //$this->subelements[$elementName][$subelementName]->setAttrib('id', '');
        $this->subelements[$elementName][$subelementName]->removeDecorator('label');
        $this->subelements[$elementName][$subelementName]->removeDecorator('HtmlTag');
        //---subelement-------------------------------------------------------//
        $subelementName = 'order';
        $this->subelements[$elementName][$subelementName] = new Zend_Form_Element_Text($subelementName);
        $this->subelements[$elementName][$subelementName]->setLabel('Порядок: ');
        //$this->subelements[$elementName][$subelementName]->setRequired(true);
        $this->subelements[$elementName][$subelementName]->setAttrib('size', 40);
        $this->subelements[$elementName][$subelementName]->setValue('100');
        //---subelement-------------------------------------------------------//
        $subelementName = 'size_id';
        $this->subelements[$elementName][$subelementName] = new Zend_Form_Element_Select($subelementName);
        $this->subelements[$elementName][$subelementName]->setLabel('Цвет: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $options = array();
        $options[''] = 'не выбрано';
        $opt = new Admin_Model_CatalogSizesModel();
        $opt = $opt->getArticles();
        if (count($opt) > 0) {
            foreach ($opt as $opt_key => $opt_item) {
                $options[$opt_item['id']] = $opt_item['title'];
            }
        }
        $this->subelements[$elementName][$subelementName]->addMultiOptions(
            $options
        );
        
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_MultiElement($elementName, array(
            'elements' => $this->subelements[$elementName],
        ));

        if(($this->_options[$elementName]['multielementOptions']) > 0) {
            $values = array();
            $subarticlesModel = new $this->_options[$elementName]['multielementOptions']['modelName']();
            $where = 0;
            if(!empty($this->_options['formValues']['id'])) {
                $where = "`{$this->_options[$elementName]['multielementOptions']['parColName']}` = '{$this->_options['formValues']['id']}'";
            }
            $subarticlesArticles = $subarticlesModel->getArticles(array(
                'where' => $where,
                'order' => 'order ASC',
            ));
            $this->groups[$groupName][$elementName]->setValue($subarticlesArticles);
        }

        $this->groups[$groupName][$elementName]->setLabel('Размер: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'img';
        $articlesModel = new Admin_Model_CatalogProductsModel();
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
                'big' => 'big_',
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
                    'targetDir' => 'original_',
                    'width' => '5000',
                    'height' => '5000',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
//                    'watermark' => 1,
//                    'watermarkFile' => 'watermark/watermark.png',
//                    'watermarkLeftProcent' => '50',
//                    'watermarkTopProcent' => '50',
//                    'watermarkPercent' => '80',
                ),
                array(
                    'targetDir' => 'big_',
                    'width' => '800',
                    'height' => '800',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
//                    'watermark' => 1,
//                    'watermarkFile' => 'watermark/watermark.png',
//                    'watermarkLeftProcent' => '50',
//                    'watermarkTopProcent' => '50',
//                    'watermarkPercent' => '80',
                ),
                array(
                    'targetDir' => 'show_',
                    'width' => '300',
                    'height' => '200',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
                array(
                    'targetDir' => 'list_',
                    'width' => '400',
                    'height' => '400',
                    'cut' => 1,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
                array(
                    'targetDir' => 'gall_',
                    'width' => '200',
                    'height' => '200',
                    'cut' => 1,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
            ),
        );
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_ImageUpload($elementName, $this->_options[$elementName], $this);
        $this->groups[$groupName][$elementName]->setLabel('Картинка: ');
        //--------------------------------------------------------------------//
        $elementName = 'img_preview';
        $articlesModel = new Admin_Model_CatalogProductsModel();
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
                'big' => 'ss_',
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
//                array(
//                    'targetDir' => 's_',
//                    'width' => '2000',
//                    'height' => '2000',
//                    'cut' => 0,
//                    'leaveTop' => 0,
//                    'extend' => 0,
//                ),
                array(
                    'targetDir' => 'ss_',
                    'width' => '400',
                    'height' => '400',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
            ),
        );
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_ImageUpload($elementName, $this->_options[$elementName], $this);
        $this->groups[$groupName][$elementName]->setLabel('Превью (не обязательно): ');
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
            'modelName' => 'Admin_Model_CatalogProductsModel',
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
            $catalogSections = new Admin_Model_CatalogProductsModel();
            $return['url'] = $catalogSections->getUrlName($return['title']);
            //$return['url'] = Mc_Functions::strUrlTranslite($return['title']);
        }
        
        unset($return['title_label']);
        
        unset($return['submit']);
        unset($return['cancel']);
        
        //unset($return['section_id']);

        return $return;
    }
}
