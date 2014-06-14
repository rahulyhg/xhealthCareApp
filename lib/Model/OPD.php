<?php

namespace healthCareApp;

class Model_OPD extends \Model_Patient{
	public $table="healthCareApp_patient";
	function init(){
		parent::init();
		

		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}