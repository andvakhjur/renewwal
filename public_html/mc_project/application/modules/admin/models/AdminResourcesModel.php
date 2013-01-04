<?php

class Admin_Model_AdminResourcesModel extends Mc_Model
{
    /**
     * Папка для сохранения файлов
     */
    const uploadDir = 'admin_resources';
    
    /**
     * Лэйбл крошки в breadcrumbs 
     */
    const crumbLabel = 'Левое меню';
    
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
        $this->_table = new Admin_Model_DbTable_AdminResourcesDbTable();
    }
    
    static public function getCrumb()
    {
        $return = array(
            'label' => self::crumbLabel,
            'uri' => Zend_Registry::get('view')->url(array('module' => Zend_Registry::get('view')->moduleName, 'controller' => 'admin-resources', 'action' => 'filter-by-par-id', 'value' => '0'), 'default', true),
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
        return new Admin_Form_AdminResourcesForm($options);
    }

    public function getFormFilter($options = null)
    {
        return new Admin_Form_Filter_AdminResourcesFilter($options);
    }
}