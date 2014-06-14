<?php

namespace healthCareApp;

class Model_Doctor extends Model_Staff{
	function init(){
		parent::init();
	
	$this->addCondition('type','Doctor');	
	$this->hasMany('healthCareApp/Assignpatients','doctor_id');	
	}

	function tryLogin($email,$password){

		$doctor=$this->add('healthCareApp/Model_Staff');

		$doctor->addCondition('email',$email); 
		$doctor->addCondition('password',$password);
		$doctor->tryLoadAny();
		if($doctor->loaded()){
			$this->api->memorize('logged_in_user',$email);
			$this->api->memorize('type_of_user','doctor');
			return true;
			}
			else{
				$this->api->forget('logged_in_user',$email);
				$this->api->forget('type_of_user',$email);
				return false;
				
			}
	}
}