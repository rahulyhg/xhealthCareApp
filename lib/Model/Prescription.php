<?php

namespace healthCareApp;

class Model_Prescription extends \Model_Table{
	public $table="healthCareApp_prescriptions";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/Doctor','doctor_id');
        $this->hasOne('healthCareApp/Patient','patient_id');
        $this->addField('name')->type('text')->caption('Prescription');
		$this->addField('prescriped_on')->type('date');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}