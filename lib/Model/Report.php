<?php

namespace healthCareApp;

class Model_Patient extends \Model_Table{
	public $table="healthCareApp_report";
	function init(){
		parent::init();


        
       
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}