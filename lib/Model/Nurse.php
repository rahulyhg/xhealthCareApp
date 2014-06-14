<?php

namespace healthCareApp;

class Model_Nurse extends Model_Staff{
	function init(){
		parent::init();
	
	$this->addCondition('type','Nurse');		
	}

	function tryLogin($email,$password){

		$doctor=$this->add('healthCareApp/Model_Staff');

		$doctor->addCondition('email',$email); 
		$doctor->addCondition('password',$password);
		$doctor->tryLoadAny();
		if($doctor->loaded()){
			$this->api->memorize('logged_in_user',$email);
			$this->api->memorize('type_of_user','nurse');
			return true;
			}
			else{
				$this->api->forget('logged_in_user',$email);
				$this->api->forget('type_of_user',$email);
				return false;
				
			}
	}
}