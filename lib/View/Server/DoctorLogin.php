<?php

namespace healthCareApp;

class View_Server_DoctorLogin extends \View{
	function init(){
		parent::init();
		
		$this->add('H1')->set('Doctor Login');
		$form=$this->add('Form');
		$form->addField('line','email')->validateNotNull('Required Field');
		$form->addField('password','password')->validateNotNull('Required Field');

		// $form->addSubmit('login');
		$form->add('Button')->set('Login')
		->addStyle(array('margin-top'=>'25px','margin-left'=>'37px'))
			->js('click')->submit();
		
		

		if($form->isSubmitted()){
		
			$doctor=$this->add('healthCareApp/Model_Doctor');
		 	if(!$doctor->tryLogin($form['email'],$form['password']))
		 		$form->displayError('email','wrong credentials');
		 	
				// Redirect to Dashboard
				$this->js()->univ()->redirect($this->api->url(null,array('subpage'=>'xhealthcare-drdashboard')))->execute();
			}
	}
}