<?php

namespace healthCareApp;

class Model_Department extends \Model_Table{
	public $table="healthCareApp_department";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/HosConfig','hosconfig_id');
        $this->addCondition('hosconfig_id',1);
        $this->addField('name');
        $this->addField('overview')->type('text');
        $this->addField('consultants');
		$this->hasMany('healthCareApp/Post','department_id');
		$this->hasMany('healthCareApp/Services','department_id');
		$this->hasMany('healthCareApp/Patient','department_id'); 
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}