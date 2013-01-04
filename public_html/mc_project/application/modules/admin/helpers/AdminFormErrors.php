<?php

class Admin_Helper_AdminFormErrors extends Zend_View_Helper_Abstract
{
    public function adminFormErrors($form)
	{
        try {
            $this->view = new Mc_View();
            
            $this->view->form = $form;
            
            return $this->view->render(Mc_Functions::strToViewName(__FUNCTION__).'.phtml');
        } catch (Exception $exception){
            throw new Mc_Exception('Exception in helper: ' . __CLASS__, 100500, $exception);
        }
	}
}