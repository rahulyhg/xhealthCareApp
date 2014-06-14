<?php

namespace healthCareApp;

class Model_Treatment extends \Model_Table{
	public $table="healthCareApp_treatment";
	function init(){
		parent::init();

        

        $this->hasOne('healthCareApp/Doctor','doctor_id');
        $this->hasOne('healthCareApp/Services','services_id');
        $this->hasOne('healthCareApp/Patient','patient_id');
        $this->addField('name');
		$this->hasMany('healthCareApp/Treatment','doctor_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}