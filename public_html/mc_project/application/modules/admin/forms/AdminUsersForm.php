<?php

class Admin_Form_AdminUsersForm extends Mc_Form
{

    public $groups = array();

    public function init()
    {
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
        $elementName = 'type';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Select($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Тип юзера: ');
        //$this->groups[$groupName][$elementName]->setRequired (true);
        $this->groups[$groupName][$elementName]->addMultiOptions(array(
            'admin' => 'Админ',
            //'moderator' => 'Модератор',
            'user' => 'Пользователь',
        ));
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'login';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Логин: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'password';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Password($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Пароль: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'group_' . $groupNumb++;
        //--------------------------------------------------------------------//
        $elementName = 'fio';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('ФИО: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'status';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('Статус: ');
        //$this->groups[$groupName][$elementName]('text', 'status')->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //--------------------------------------------------------------------//
        $elementName = 'avatar';
        $articlesModel = new Admin_Model_AdminUsersModel();
        // получаем данные из таблицы
        $front = Zend_Controller_Front::getInstance();
        $id = $front->getRequest()->getParam('id', null);
        if (null != $id) {
            $values = $articlesModel->getArticle($id);
        }
        
        $this->_options[$elementName] = array(
            'fileUrl' => $articlesModel->getUrlUpload() . '/images',
            'filePath' => $articlesModel->getPathUpload() . '/images',
            'fileName' => $values[$elementName],
            'groupName' => $groupName,
            'previewPrefix' => array(
                'small' => 'adm_',
                'big' => 's_',
            ),
            'sizes' => array(
                array(
                    'targetDir' => 'adm_',
                    'width' => '100',
                    'height' => '100',
                    'cut' => 1,
                    'leaveTop' => 1, // 1 - оставляем верх, 0 - оставляем середину (актуально только при cut=1)
                    'extend' => 0, // 1 - даже если картинка меньше, всё-равно натягиваем её на нужный размер
                ),
                array(
                    'targetDir' => 's_',
                    'width' => '800',
                    'height' => '800',
                    'cut' => 0,
                    'leaveTop' => 0,
                    'extend' => 0,
                ),
                array(
                    'targetDir' => 'ss_',
                    'width' => '300',
                    'height' => '300',
                    'cut' => 1,
                    'leaveTop' => 1,
                    'extend' => 0,
                ),
            ),
        );
        $this->groups[$groupName][$elementName] = new Mc_Form_Element_ImageUpload($elementName, $this->_options[$elementName], $this);
        $this->groups[$groupName][$elementName]->setLabel('Картинка: ');
        //####################################################################//
        
        //####################################################################//
        // Next group
        $groupName = 'full_info';
        //--------------------------------------------------------------------//
        $elementName = 'email';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Text($elementName);
        $this->groups[$groupName][$elementName]->setLabel('E-mail: ');
        //$this->groups[$groupName][$elementName]->setRequired(true);
        $this->groups[$groupName][$elementName]->setAttrib('size', 86);
        //####################################################################//
        
        
        //####################################################################//
        // Next group
        $groupName = 'permissions';
        //--------------------------------------------------------------------//
        $elementName = 'check_all_top';
        $i=0;
        $height = '30px';
        $marginTopLabel = '-8px';
        $backgroundColor = '#D7D7D7';//'#CCD0CC';
        $menuNameColor = '#ff3333';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Checkbox($elementName);
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => "<span><label style=\"height:{$height}; width:500px; margin-top:{$marginTopLabel}; margin-left:12px;\">" . 'Отметить все' . ': </label></span>'));
        $this->groups[$groupName][$elementName]->setAttrib('style', 'margin-left:100px; margin-top:8px;');
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //$this->groups[$groupName][$elementName]->setValue(isset($permissionsArr[$resourcesArr_item['id']]));// если есть в доступных, поставится галка
        $this->groups[$groupName][$elementName]->removeDecorator('Label');
        $this->groups[$groupName][$elementName]->addDecorator('HtmlTag', array('tag' => 'div', 'style' => "height:{$height};background-color:{$backgroundColor}; margin-top:15px;"));
        //--------------------------------------------------------------------//
        $table = new Mc_Admin_PermissionsList();
        $resourcesArr = $table->getPermissionsList(array(
            'only_show_in_permissions' => true,
        ));
        
        $front = Zend_Controller_Front::getInstance();
        if ($front->getRequest()->getParam('id')) {
            // permissions
            $table_permissions = new Mc_Acl_Permissions();
            $select = $table_permissions->getAdapter()
                ->select()
                ->from($table_permissions->info('name'), array('res_id', 'res_id'))// так задумано - 'res_id', 'res_id'
                ->where($table_permissions->getAdapter()->quoteIdentifier( $table_permissions->info('name') . '.user_id') . ' = ?', $id);
            $permissionsArr = $table_permissions->getAdapter()->fetchPairs($select);
        }
        
        $menuModel = new Admin_Model_AdminResourcesModel();
        $menuArr = $menuModel->getArticles(array(
            "where" => "`type`='menu'",
        ));
        
        if (count($resourcesArr) > 0) {
            $i=0;
            $height = '30px';
            $marginTopLabel = '-8px';
            foreach ($resourcesArr as $resourcesArr_key => $resourcesArr_item) {
                $i++;
                if(0 == $i%2) {
                    $backgroundColor = '#DDE1DD;';
                } else {
                    $backgroundColor = 'none';
                }
                $menuNameColor = '#ff3333';
                
                
                $elementName = 'permission' . $resourcesArr_item['id'];
                
                $parentsArr = array();
                $par_id = $resourcesArr_item['par_id'];
                
                while($par_id) {
                    $flag = false;
                    foreach ($menuArr as $key => $item) {
                        if($item['id'] == $par_id) {
                            $par_id = $item['par_id'];
                            $parentsArr[] = $item['title'];
                            $flag = true;
                            break;
                        }
                    }
                    
                    if(!$flag) {
                        break;
                    }
                }
                
                if(count($parentsArr) > 0) {
                    $parentsArr = array_reverse($parentsArr);
                    $parsTitle = '(' . implode(' / ', $parentsArr) . ') ';
                    $parsTitle = "<span style=\"color:{$menuNameColor}\">(" . implode(' / ', $parentsArr) . ")</span> ";
                } else {
                    $parsTitle = '';
                }
                
                
                
                $this->groups[$groupName][$elementName] = new Zend_Form_Element_Checkbox($elementName);
                $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => "<span><label style=\"height:{$height}; width:500px; margin-top:{$marginTopLabel}; margin-left:12px;\">" . $parsTitle . $resourcesArr_item['title'] . ': </label></span>'));
                $this->groups[$groupName][$elementName]->setAttrib('style', 'margin-left:100px; margin-top:8px;');
                $this->groups[$groupName][$elementName]->setAttrib('class', 'perm_checkbox');
                $this->groups[$groupName][$elementName]->setAttrib('size', 40);
                $this->groups[$groupName][$elementName]->setValue(isset($permissionsArr[$resourcesArr_item['id']]));// если есть в доступных, поставится галка
                $this->groups[$groupName][$elementName]->removeDecorator('Label');
                $this->groups[$groupName][$elementName]->addDecorator('HtmlTag', array('tag' => 'div', 'style' => "height:{$height};background-color:{$backgroundColor};"));
            }
        }
        //--------------------------------------------------------------------//
        $elementName = 'check_all_bottom';
        $i=0;
        $height = '30px';
        $marginTopLabel = '-8px';
        $backgroundColor = '#D7D7D7';//'#CCD0CC';
        $menuNameColor = '#ff3333';
        $this->groups[$groupName][$elementName] = new Zend_Form_Element_Checkbox($elementName);
        $this->groups[$groupName][$elementName]->addDecorator('Labelsid', array('before' => "<span><label style=\"height:{$height}; width:500px; margin-top:{$marginTopLabel}; margin-left:12px;\">" . 'Отметить все' . ': </label></span>'));
        $this->groups[$groupName][$elementName]->setAttrib('style', 'margin-left:100px; margin-top:8px;');
        $this->groups[$groupName][$elementName]->setAttrib('size', 40);
        //$this->groups[$groupName][$elementName]->setValue(isset($permissionsArr[$resourcesArr_item['id']]));// если есть в доступных, поставится галка
        $this->groups[$groupName][$elementName]->removeDecorator('Label');
        $this->groups[$groupName][$elementName]->addDecorator('HtmlTag', array('tag' => 'div', 'style' => "height:{$height};background-color:{$backgroundColor}; margin-top:0px;"));
        //####################################################################//
        
        
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
    public function mapForm()
    {
        // маппим элементы в зависимости от их типа
        $return = parent::mapForm();

        // маппим конкретные элементы
        $values = $this->getValues();
        if(!empty($values['password'])) {
            $return['password'] = sha1($values['password'] . 'ex44ut');
        } else {
            unset($return['password']);
        }
        
        
//        $last_visit = new Zend_Date($values['last_visit']);
//        $return['last_visit'] = $last_visit->toString('yyyy-MM-dd HH:mm:ss');


        unset($return['submit']);
        unset($return['cancel']);
        unset($return['check_all_top']);
        unset($return['check_all_bottom']);
        
        
        
        if (count($values) > 0) {
            foreach ($values as $values_key => $values_item) {
                if (preg_match('/^permission[\d]+/', $values_key)) {
                    if ('1' == $values_item) {
                        $return['permissions'][] = str_replace('permission', '', $values_key);
                    }
                    unset($return[$values_key]);
                }
            }
        }
        
        return $return;
    }
    
    /**
     * Маппим данные для сохранения
     */
    public function updateUserPermissions($row, $permissions)
    {
        if($row instanceof Zend_Db_Table_Row) {
            $id = $row->toArray();
            $id = $id['id'];
        } else {
            $id = $row;
        }
        
        
        
		$adapter = Zend_Db_Table::getDefaultAdapter();
        $table_permissions = new Mc_Acl_Permissions();
        $name = $table_permissions->info('name');
        
        

        $where = array(
            $adapter->quoteInto($name . '.user_id =  ?', $id),
            $adapter->quoteInto($name . '.res_id  not in (?)', $permissions)
        );
        
        $adapter->delete($name, $where);

        $select = $adapter
            ->select()
            ->from($name, array('res_id', 'res_id'))// так задумано - 'res_id', 'res_id'
            ->where($adapter->quoteIdentifier($name . '.user_id') . ' = ?', $id);
        
        //echo $select;exit();
        
        $in_db = $adapter->fetchPairs($select);
        
        foreach (array_diff($permissions, $in_db) as $res_id) {
            $table_permissions->insert(
                array(
                    'res_id' => $res_id,
                    'user_id' => $id,
                    'permission' => 'allow'
                )
            );
        }
    }
}
