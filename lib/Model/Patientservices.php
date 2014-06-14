<?php

namespace healthCareApp;

class Model_Patientservices extends \Model_Table{
	public $table="healthCareApp_patientservices";
	function init(){
		parent::init();

		$this->hasOne('healthCareApp/Services','services_id');
		$this->hasOne('healthCareApp/Patient','patient_id');
        $this->addField('name')->type('text')->caption('Detail Description');
        $this->addField('treat_on')->type('date');
		$this->hasMany('healthCareApp/Treatment','patientservices_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}