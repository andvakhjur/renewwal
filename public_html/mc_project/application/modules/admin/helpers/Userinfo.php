<?php 
class Admin_Helper_Userinfo
{
	public function userinfo()
	{
		try {
            $auth = Zend_Auth::getInstance();
            $info = $auth->getIdentity();
            return $info;
        } catch (Exception $exception){
            throw new Mc_Exception('Exception in helper: ' . __CLASS__, 100500, $exception);
        }
	}

}