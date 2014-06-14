<?php

namespace healthCareApp;

class Model_Services extends \Model_Table{
	public $table="healthCareApp_services";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/Department','department_id');
        $this->addField('name');
		$this->hasMany('healthCareApp/Patientservices','services_id');
		$this->addField('charges')->type('text');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}