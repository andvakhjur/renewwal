<?php

class Admin_AdminAjaxController extends Mc_Controller_Action
{
    public function init()
    {
        parent::init();
    }
    
    public function selectajaxAction()
    {
        $secondSelectModelName = $this->_getParam('secondSelectModelName');
        
        $secondModel = new $secondSelectModelName;
        if("" != $this->_getParam('firstSelectVal')) {
            $secondOptions = $secondModel->getArticles(array(
                'where' => '`' . $this->_getParam('secondSelectColNamePar') . '`=\'' . $this->_getParam('firstSelectVal') . '\'',
            ));
        } else {
            $secondOptions = array();//$secondModel->getArticles();
        }
        
        
        $response['html'] = '<option label="все" value="">все</option>';
        if (count($secondOptions) > 0) {
            foreach ($secondOptions as $secondOptions_key => $secondOptions_item) {
                $response['html'] .= '<option label="' . $this->view->escape($secondOptions_item[$this->_getParam('secondSelectColNameTitle')]) . '" value="' . $this->view->escape($secondOptions_item[$this->_getParam('secondSelectColNameId')]) . '">' . $secondOptions_item[$this->_getParam('secondSelectColNameTitle')] . '</option>';
            }
        }
        
        $this->_helper->json($response);
    }
}