<?php

class Admin_Model_CatalogProductsModel extends Mc_Model
{
    /**
     * Папка для сохранения файлов
     */
    const uploadDir = 'catalog_products';
    
    /**
     * Лэйбл крошки в breadcrumbs 
     */
    const crumbLabel = 'Товары';
    
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
        $this->_table = new Admin_Model_DbTable_CatalogProductsDbTable();
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
        return new Admin_Form_CatalogProductsForm($options);
    }

    public function getFormFilter($options = null)
    {
        return new Admin_Form_Filter_CatalogProductsFilter($options);
    }
    
    /*
     * Форматирует вывод цены
     */
    static public function priceFormat($price, $rate = null)
    {
//        $rateValue = Zend_Registry::get('view')->rateValue['value'];
//        
//        if('usd' == $rate && $rateValue > 0) {
//            $price /= $rateValue;
//        }
        return number_format(ceil($price), 0, '.', ' ');
    }
}