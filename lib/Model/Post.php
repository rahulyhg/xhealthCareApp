<?php

namespace healthCareApp;

class Model_Post extends \Model_Table{
	public $table="healthCareApp_post";
	function init(){
		parent::init();
        
        $this->hasOne('healthCareApp/Department','department_id');
       
        $this->addField('name')->caption('employeepost');
        $this->addField('salaryamount');
        $this->addField('leaves_allowed')->type('int');
		$this->hasMany('healthCareApp/Staff','post_id');
		$this->hasMany('healthCareApp/Attendance','post_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}