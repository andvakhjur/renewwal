<?php

class Admin_Model_ArticlesModel extends Mc_Model
{
    /**
     * Папка для сохранения файлов
     */
    const uploadDir = 'articles';
    
    /**
     * Лэйбл крошки в breadcrumbs 
     */
    const crumbLabel = 'Статьи';
    
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
        $this->_table = new Admin_Model_DbTable_ArticlesDbTable();
    }
    
    static public function getCrumb()
    {
        preg_match_all('/[A-Z]{1}[a-z]+/', preg_replace(array('/^Admin_Model_/', '/Model$/'), array('', ''), __CLASS__), $matches);
        $return = array(
            'label' => Zend_Registry::get('view')->translate(self::crumbLabel),
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
        return new Admin_Form_ArticlesForm($options);
    }

    public function getFormFilter($options = null)
    {
        return new Admin_Form_Filter_ArticlesFilter($options);
    }
}