<?php

namespace healthCareApp;

class Model_Schedule extends \Model_Table{
	public $table="healthCareApp_schedule";
	function init(){
		parent::init();

		$this->hasOne('healthCareApp/Staff','staff_id');
		
        $this->addField('date')->type('date');
        $this->addField('name')->caption('Work');
        $this->addField('time');
        $this->addField('is_work_done')->type("boolean");
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}