<?php

class Admin_Model_AdminProfileModel extends Mc_Model
{
    /**
     * Папка для сохранения файлов
     */
    const uploadDir = 'admin_users';
    
    /**
     * Лэйбл крошки в breadcrumbs 
     */
    const crumbLabel = 'Профиль';
    
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
    
    /**
     * Время жизни сессии
     */
    protected $_session_time;
    
    public function __construct()
    {
        $this->_table = new Admin_Model_DbTable_AdminProfileDbTable();
        $this->_session_time = 24 * 3600; //Запомнили на 24 часа
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
    
    public function logout()
    {
        Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('cabinet'))->clearIdentity();
        return;
    }
    
    public function authenticate($login = null, $password = null)
    {
        try {
            if (!isset($login) || !isset($password)) {
                throw new Exception('Authentication failed: login or password is incorrect.');
            }

            $dbAdapters = Zend_Registry::get('dbAdapters');
            $db = $dbAdapters['default'];

            $authAdapter = new Zend_Auth_Adapter_DbTable($db);
            $authAdapter->setTableName($this->getDbProperty('name'))
                ->setIdentityColumn('login')
                ->setCredentialColumn('password')
                ->setIdentity($login)
                ->setCredential($this->encode($password));

            $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('cabinet'));
            $result = $auth->authenticate($authAdapter);

            
            
            if ($result->isValid()) {
                $auth->getStorage()->write($authAdapter->getResultRowObject(null, 'password'));
                $session = new Zend_Session_Namespace('cabinet');
                $session->setExpirationSeconds($this->_session_time);
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getTraceAsString();
            return false;
        }
    }
    
    public function getDbProperty($property = null)
    {
        return $this->_table
                ->info($property);
    }
    
    private function encode($password = '')
    {
        return sha1($password . 'ex44ut');
    }
    
    public function getForm($options = null)
    {
        return new Admin_Form_AdminProfileForm($options);
    }

    public function getFormFilter($options = null)
    {
        return new Admin_Form_Filter_AdminProfileFilter($options);
    }
}