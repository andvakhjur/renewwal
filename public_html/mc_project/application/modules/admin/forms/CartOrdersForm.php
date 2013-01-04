<?php

class Admin_Form_CartOrdersForm extends Mc_Form {

    public $groups = array();

    public function init() {
        parent::init();

        $this->setMethod('post');
        $helperUrl = new Zend_View_Helper_Url();
        $this->setAction($helperUrl->url(array('module' => Zend_Registry::get('view')->moduleName, 'controller' => Zend_Registry::get('view')->controllerName, 'action' => Zend_Registry::get('view')->actionName), 'default', true));

        $groupNumb = 0;
        $elementNumb = 0;
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'datetime';
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_Datetime($elementName);
        $this->groups[$groupName][$elementName]->setRequired(false);
        $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Date(array('dd.MM.YYYY HH:mm:ss')), true);
        $this->groups[$groupName][$elementName]->addFilter(new Zend_Filter_StringTrim());
        $this->groups[$groupName][$elementName]->addDecorator('DateTimepicker');
        $this->groups[$groupName][$elementName]->setLabel('Время публикации: ');
        //--------------------------------------------------------------------//
        $elementName = 'progress';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Прогресс: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        //$this->groups[$groupName][$elementName]->setAttrib('size', 40);
        $this->groups[$groupName][$elementName]->addMultiOptions(array(
            'new' => 'новый',
            'in_progress' => 'в процессе',
            'done' => 'выполнен',
        ));
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //if(!empty($this->_options['formValues']['user_id']) || 'add' == Zend_Controller_Front::getInstance()->getRequest()->getParam('action')) {
            //----------------------------------------------------------------//
            $elementName = 'html_user';
            ob_start();?>
            <strong>
                Пользователь
            </strong>
            <?php $html = ob_get_contents();ob_end_clean();
            $this->groups[$groupName][$elementName] = new Mc_Form_Element_Html($elementName, array(
                "html" => $html,
            ));
            $this->groups[$groupName][$elementName]->setLabel('');
            //----------------------------------------------------------------//
            $elementName = 'user_id';
            $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
            $this->groups[$groupName][$elementName]->setLabel('Пользователь: ');
            //$this->groups[$groupName][$elementName]->setRequired (true);
            $options = array();
            $options[''] = 'не выбрано';
            $opt = new Admin_Model_AdminUsersModel();
            $opt = $opt->getArticles(array(
                "order" => "fio ASC",
                "where" => "`type`='user'"
            ));
            if (count($opt) > 0) {
                foreach ($opt as $opt_key => $opt_item) {
                    $options[$opt_item['id']] = $opt_item['fio'];
                }
            }
            $this->groups[$groupName][$elementName]->addMultiOptions(
                $options
            );
        //}
        
        // инфо о юзере
        if(!empty($this->_options['formValues']['user_id'])) {
            $usersModel = new Admin_Model_AdminUsersModel();
            $user = $usersModel->getArticle($this->_options['formValues']['user_id']);
            $elementName = 'html_user_info';
            
            ob_start();?>
            <div style="margin-left: 50px;">
                <p>
                    <b>Имя:</b> <?php echo $user['fio'];?>
                </p>
                <p>
                    <b>Телефон:</b> <?php echo $user['phone'];?>
                </p>
                <p>
                    <b>Email:</b> <?php echo $user['email'];?>
                </p>
            </div>
            <?php $html = ob_get_contents();ob_end_clean();
            $this->groups[$groupName][$elementName] = new Mc_Form_Element_Html($elementName, array(
                "html" => $html,
            ));
            $this->groups[$groupName][$elementName]->setLabel('');
            
        }
        //--------------------------------------------------------------------//
        if(empty($this->_options['formValues']['user_id'])) {
            $elementName = 'html_guest';
            ob_start();?>
            <strong>
                Гость
            </strong>
            <?php $html = ob_get_contents();ob_end_clean();
            $this->groups[$groupName][$elementName] = new Mc_Form_Element_Html($elementName, array(
                "html" => $html,
            ));
            $this->groups[$groupName][$elementName]->setLabel('');
            //----------------------------------------------------------------//
            $elementName = 'user_fio';
            $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
            $this->groups[$groupName][$elementName]->setLabel('ФИО: ');
            //$this->groups[$groupName][$elementName]->setRequired(true);
            $this->groups[$groupName][$elementName]->setAttrib('size', 40);
            //----------------------------------------------------------------//
            $elementName = 'user_email';
            $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
            $this->groups[$groupName][$elementName]->setLabel('E-mail: ');
            //$this->groups[$groupName][$elementName]->setRequired(true);
            $this->groups[$groupName][$elementName]->setAttrib('size', 40);
            //----------------------------------------------------------------//
            $elementName = 'user_phone';
            $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
            $this->groups[$groupName][$elementName]->setLabel('Телефон: ');
            //$this->groups[$groupName][$elementName]->setRequired(true);
            $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        }
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'user_address';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Адрес: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
        //--------------------------------------------------------------------//
        $elementName = 'user_message';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Textarea($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Дополнительно: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->setAttrib('cols', 40);
        $this->groups[$groupName][$elementName]->setAttrib('rows', 4);
        //####################################################################//
        
        
        
        if(!empty($this->_options['formValues']['id'])) {
            //################################################################//
            // Next group
            $groupName = 'group_' . $groupNumb++;
            //--------------------------------------------------------------------//
            $elementName = 'summ';
            $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
            $this->groups[$groupName][$elementName]->setLabel('Сумма: ');
            //$this->groups[$groupName][$elementName]->setRequired(true);
            $this->groups[$groupName][$elementName]->setAttrib('size', 86);
            $this->groups[$groupName][$elementName]->addValidator(new Zend_Validate_Float(array(
                "locale" => "en_US",
            )));
            //----------------------------------------------------------------//
            $elementName = 'html_products';
            ob_start();?>
            <div style="overflow:hidden; margin-left:10px; text-align:left; min-width:120px;">
                <?php
                $title = "Товары";
                $colName = "order_id";
                $actionName = "filter-by-order-id";
                $controllerName = "cart-orders-products";
                $model = new Admin_Model_CartOrdersProductsModel();

                $articles = $model->getArticles(array(
                    "where" => "`{$colName}`='{$this->_options['formValues']['id']}'",
                ));

                $count = '0';
                if(null !== $articles) {
                    $count = count($articles);
                }

                if ($count > 0) {
                    $count = "<span style='color:#55aa55'>{$count}</span>";
                } else {
                    $count = "<span style='color:#aa5555'>{$count}</span>";
                }
                ?>
                <?php $view = new Mc_View();?>
                <strong>Содержимое заказа:</strong>
                <a href="<?php echo $view->url(array("controller" => $controllerName, "action" => $actionName, "value" => $this->_options['formValues']['id']), "admin-base", true); ?>">
                    <?php echo $title; ?> (<?php echo $count;?>)
                </a>
            </div>
            <div>
                <?php
                $ordersProductsModel = new Admin_Model_CartOrdersProductsModel();
                $productsModel = new Admin_Model_CatalogProductsModel();
                $products = $ordersProductsModel->getArticles(array(
                    "where" => "`order_id`='{$this->_options['formValues']['id']}'",
                ));
                ?>
                <?php if(count($products) > 0) {?>
                    <?php foreach($products as $key => $item) {?>
                        <?php $product = $productsModel->getArticle($item['prod_id']);?>
                        <a href="<?php echo $view->url(array("controller" => "catalog-products", "action" => "edit", "id" => $item['id']), "admin-base"); ?>"><?php echo $product['title'];?></a>
                        
                        <?php if(!empty($item['count'])) {?>
                            ,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            количество:
                            <span>
                                <?php echo $item['count'];?>
                            </span>
                        <?php }?>
                        <?php if(!empty($item['summ'])) {?>
                            ,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            сумма:
                            <span>
                                <?php echo $item['summ'];?>
                            </span>
                        <?php }?>
                        <br />
                    <?php }?>
                <?php }?>
            </div>
            <?php $html = ob_get_contents();ob_end_clean();
            $this->groups[$groupName][$elementName] = new Mc_Form_Element_Html($elementName, array(
                "html" => $html,
            ));
            $this->groups[$groupName][$elementName]->setLabel('');
            //################################################################//
        }
        
        
        //####################################################################//
        // Buttons
        $groupName = 'buttons';
        //--------------------------------------------------------------------//
        $elementName = 'id';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Hidden($elementName);
        $this->groups[$groupName][$elementName]->removeDecorator('label');
        $this->groups[$groupName][$elementName]->removeDecorator('HtmlTag');
        //--------------------------------------------------------------------//
        $elementName = 'submit';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Submit($elementName, array(
                'label' => 'Сохранить',
                'class' => 'save_but'
            ));
        $this->groups[$groupName][$elementName]->clearDecorators();
        $this->groups[$groupName][$elementName]->addDecorator('ViewHelper');
        //--------------------------------------------------------------------//
        $elementName = 'cancel';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Submit($elementName, array(
                'label' => 'Отменить',
                'class' => 'cancel_but'
            ));
        $this->groups[$groupName][$elementName]->clearDecorators();
        $this->groups[$groupName][$elementName]->addDecorator('ViewHelper');
        //####################################################################//
        
        
        //####################################################################//
        // Добавляем группы к форме
        //####################################################################//

        if (count($this->groups) > 0) {
            foreach ($this->groups as $key => $item) {
                switch ($key) {
                    case 'buttons':
                        $this->addDisplayGroup($item, $key, array('class' => 'form_group_buttons'));
                        break;
                    default:
                        $this->addDisplayGroup($item, $key, array('class' => 'form_group'));
                        break;
                }
            }
        }
    }

    /**
     * преобразует POST в нужный для сохранения формат
     */
    public function mapForm() {
        // маппим элементы в зависимости от их типа
        $return = parent::mapForm();
//        Zend_Debug::dump($return);exit();


        // маппим конкретные элементы
        //$values = $this->getValues();
        //$datetime = new Zend_Date($values['datetime']);
        //$return['datetime'] = $datetime->toString('yyyy-MM-dd HH:mm:ss');
        
        if(empty($return['url']) && $this->getElement('url')) {
            $catalogSections = new Admin_Model_CartOrdersModel();
            $return['url'] = $catalogSections->getUrlName($return['title']);
            //$return['url'] = Mc_Functions::strUrlTranslite($return['title']);
        }
        
        unset($return['html_user']);
        unset($return['html_user_info']);
        unset($return['html_guest']);
        unset($return['html_products']);
        
        
        unset($return['submit']);
        unset($return['cancel']);

        return $return;
    }
}
