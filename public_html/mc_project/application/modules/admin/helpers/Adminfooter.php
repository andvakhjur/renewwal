<?php

class Admin_Helper_Adminfooter extends Zend_View_Helper_Abstract
{
    public function adminfooter()
	{
        try {
            $this->view = new Mc_View();
            $this->view->current_user = Zend_Auth::getInstance()
                ->setStorage(new Zend_Auth_Storage_Session('cabinet'))
                ->getStorage()
                ->read();
            return $this->view->render(Mc_Functions::strToViewName(__FUNCTION__).'.phtml');
        } catch (Exception $exception){
            throw new Mc_Exception('Exception in helper: ' . __CLASS__, 100500, $exception);
        }
	}
}