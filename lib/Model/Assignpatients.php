<?php

namespace healthCareApp;

class Model_Assignpatients extends \Model_Table{
	public $table="healthCareApp_assignpatientstostaff";
	function init(){
		parent::init();

		
		// $this->hasOne('healthCareApp/Staff','staff_id');
		$this->hasOne('healthCareApp/Doctor','doctor_id');
		$this->hasOne('healthCareApp/Patient','patient_id');
        $this->addField('assign_on')->type('date');
        $this->addField('disease');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}