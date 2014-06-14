<?php

namespace healthCareApp;

class Model_HosConfig extends \Model_Table{
	public $table="healthCareApp_hosconfig";
	function init(){
		parent::init();

		
        $this->addField('hospital_name');
        $this->addField('hospital_address')->type('text');
        $this->addField('hospital_terms_&_conditions')->type('text');
        $this->addField('email');
        $this->addField('user_name');
        $this->addField('password')->type('password');
      
		$this->hasMany('healthCareApp/Department','hosconfig_id');
		$this->hasMany('healthCareApp/Ward','hosconfig_id');
		$this->hasMany('healthCareApp/Roomcategory','hosconfig_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}