<?php

class Admin_Model_CatalogProductsColorsModel extends Mc_Model
{
    /**
     * Папка для сохранения файлов
     */
    const uploadDir = 'catalog_products_colors';
    
    /**
     * Лэйбл крошки в breadcrumbs 
     */
    const crumbLabel = 'Цвета';
    
    /**
     * Объект-таблица, с которой мы работаем (может потребоваться добавить и другие)
     * @var Mc_Db_Table
     */
    protected $_table;
    
    /**
     * Форма
     * @var Mc_Form
     */
    protected $_form = null;
    
    /**
     * Фильтр
     * @var Mc_Form
     */
    protected $_formFilter = null;
    
    public function __construct()
    {
        $this->_table = new Admin_Model_DbTable_CatalogProductsColorsDbTable();
    }
    
    static public function getCrumb()
    {
        preg_match_all('/[A-Z]{1}[a-z]+/', preg_replace(array('/^Admin_Model_/', '/Model$/'), array('', ''), __CLASS__), $matches);
        $return = array(
            'label' => self::crumbLabel,
            'controllerName' => strtolower(implode('-', $matches[0])),
        );
        return $return;
    }
    
    static public function getUrlUpload()
    {
        return Zend_Registry::get('config')->url->upload . '/' . self::uploadDir;
    }
    
    static public function getPathUpload()
    {
        return Zend_Registry::get('config')->path->upload . '/' . self::uploadDir;
    }
    
    public function getForm($options = null)
    {
        return new Admin_Form_CatalogProductsColorsForm($options);
    }

    public function getFormFilter($options = null)
    {
        return new Admin_Form_Filter_CatalogProductsColorsFilter($options);
    }
    
    /**
     * С дополнительными данными
     */
    public function getSqlFull($options = array())
    {
        $dba = Zend_Db_Table::getDefaultAdapter();
        
        $productsColorsTable = $this->getTable();
        $colorsTable = new Admin_Model_DbTable_CatalogColorsDbTable();
        
        $select1 = $dba->select();
        
        $select1->from(array("p" => $productsColorsTable->info('name')), array(
            '*',
        ));
        //--------------------------------------------------------------------//
        $select1->from(array("s" => $colorsTable->info('name')), array(
            "color_title" => "title",
        ));
        $select1->where("`s`.`id`=`p`.`color_id`");
        //--------------------------------------------------------------------//
        
        $select = $select1;
        
        //echo $select;exit();
        
        return $select;
    }
    
    public function getArticlesFull($options = array())
    {
        $options['select'] = $this->getSqlFull($options);
        //echo $options['select'];exit();
        return $this->getArticles($options);
    }
    
    public function getPaginatorFull($options = array())
    {
        $options['select'] = $this->getSqlFull($options);
        $options['adapter'] = "Zend_Paginator_Adapter_DbSelect";
        
        return $this->getPaginator($options);
    }
}