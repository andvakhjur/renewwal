<?php

class Admin_Form_AdminLoginForm extends Mc_Form
{
	public function init(){

		$this->setMethod('post');
		$this->setName('formlogin');
		$helperUrl = new Zend_View_Helper_Url();
		$this->setAction($helperUrl->url(array('module' => 'admin', 'controller' => 'admin-auth', 'action' => 'login'), 'default', true));

		$login = new Zend_Form_Element_Text('login', array(
			'label'	      => 'Логин:',
			'required'    => true,
			'maxlength'   => '30',
			'validators'  => array(
				array('StringLength', true, array(0, 255))
			),
			'filters'     => array('StringTrim', 'StripTags'),
		));
		$this->addElement($login);

		$password = new Zend_Form_Element_Password('password', array(
			'required'    => true,
			'label'       => 'Пароль:',
			'maxlength'   => '30',
			'validators'  => array(
				array('StringLength', true, array(0, 255))
			),
			'filters'     => array('StringTrim', 'StripTags'),
		));
		$this->addElement($password);

		$submit = new Zend_Form_Element_Submit('submit', array(
			'label'       => 'Войти',
		));
		$this->addElement($submit);
	}
}