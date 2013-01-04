<?php

class Admin_Helper_Banner
{

    public function banner($id)
    {
        try {
            $this->view = Zend_Registry::get('view');

            $articlesModle = new Admin_Model_BannersArticlesModel();
            $this->view->banner = $articlesModle->getArticle($id);

            return $this->view->render(Mc_Functions::strToViewName(__FUNCTION__) . '.phtml');
        } catch (Exception $exception) {
            throw new Mc_Exception('Exception in helper: ' . __CLASS__, 100500, $exception);
        }
    }

}