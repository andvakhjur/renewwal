<?php

class Admin_Helper_Adminmenu extends Zend_View_Helper_Abstract
{
	protected $_menu;
    protected $_resourceName;
    
    public function adminmenu()
	{
        try {
            $this->view = new Mc_View();
            $table = new Mc_Admin_Menu();
            $menuArr = $table->getNestedMenu(array(
                'only_show_in_menu' => true,
            ));
            
            $this->view->menu = $menuArr;
            
            $front = Zend_Controller_Front::getInstance();
            $this->view->resource = Zend_Registry::get('resource');
            
            return $this->view->render(Mc_Functions::strToViewName(__FUNCTION__).'.phtml');
        } catch (Exception $exception){
            throw new Mc_Exception('Exception in helper: ' . __CLASS__, 100500, $exception);
        }
	}
    
    
}