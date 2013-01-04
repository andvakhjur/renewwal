<?php

class Admin_AdminAuthController extends Mc_Controller_Action
{

    private $_sessionNamespace;

    public function init()
    {
        parent::init();
        
        $this->_layout->setLayout('layout-login');
        $this->_sessionNamespace = new Zend_Session_Namespace('admin-' . $this->_controllerName);
    }

    public function loginAction()
    {
        //		Zend_Layout::getMvcInstance()->disableLayout();
        $form = new Admin_Form_AdminLoginForm();
        
        if ($this->_request->isPost()) {
            if ($form->isValid($this->_getAllParams())) {
                $login = $this->_request->getPost('login');
                $password = $this->_request->getPost('password');

                $_model_users = new Admin_Model_AdminUsersModel();

                if ($_model_users->authenticate($login, $password)) {
                    echo 'you are logged<br/>';
                    $this->_redirect($this->_sessionNamespace->log_uri);
                } else {
                    echo 'error login';
                }
            }
        } else {
            $log_uri = new Zend_Controller_Request_Http();
            $this->_sessionNamespace->log_uri = $log_uri->getRequestUri();
        }

        $this->view->form = $form;
        
        $this->_layout->content = $this->view->render($this->view->controllerName . '/' . Mc_Functions::strToViewName(str_replace('Action', '', __FUNCTION__)) . '.phtml');
        echo $this->_layout->render();
    }
    
    public function logoutAction()
    {
        $_model_users = new Admin_Model_AdminUsersModel();
        $_model_users->logout();
        $this->_redirect('/admin');
    }
}
