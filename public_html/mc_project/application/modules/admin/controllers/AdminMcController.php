<?php


class Admin_AdminMcController extends Mc_Controller_Action
{
    public function init()
    {
        parent::init();
        $this->_layout->setLayout('layout');
    }
    public function indexAction()
    {
        $this->_layout->content = $this->view->render($this->view->controllerName . '/' . Mc_Functions::strToViewName(str_replace('Action', '', __FUNCTION__)) . '.phtml');
        echo $this->_layout->render();
	}
    
    public function noallowedAction()
    {
        $this->_layout->content = $this->view->render($this->view->controllerName . '/' . Mc_Functions::strToViewName(str_replace('Action', '', __FUNCTION__)) . '.phtml');
        echo $this->_layout->render();
    }
}