<?php

class Admin_Helper_Admininformation extends Zend_View_Helper_Abstract
{
	public function admininformation()
	{
        try {
            $this->view = new Mc_View();
            $flashMessenger = new Zend_Controller_Action_Helper_FlashMessenger();
            $messages = $flashMessenger->getMessages();
            //throw new Exception('hello');
            if(sizeof($messages) > 0){
                $this->view->flashMessages = $messages;
                return $this->view->render(Mc_Functions::strToViewName(__FUNCTION__).'.phtml');
            }
            return;
        } catch (Exception $exception){
            throw new Mc_Exception('Exception in helper: ' . __CLASS__, 100500, $exception);
        }
	}
}