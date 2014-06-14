<?php

namespace healthCareApp;

class Model_Receptionist extends Model_Staff{
	function init(){
		parent::init();
	
	$this->addCondition('type','Receptionist');		
	}

	function tryLogin($email,$password){

		$doctor=$this->add('healthCareApp/Model_Staff');

		$doctor->addCondition('email',$email); 
		$doctor->addCondition('password',$password);
		$doctor->tryLoadAny();
		if($doctor->loaded()){
			$this->api->memorize('logged_in_user',$email);
			$this->api->memorize('type_of_user','receptionist');
			return true;
			}
			else{
				$this->api->forget('logged_in_user',$email);
				$this->api->forget('type_of_user',$email);
				return false;
				
			}
	}
}