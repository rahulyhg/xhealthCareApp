<?php

namespace healthCareApp;

class Model_Ward extends \Model_Table{
	public $table="healthCareApp_ward";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/HosConfig','hosconfig_id');
        $this->addField('name');
        $this->addField('description')->type('text');
        $this->addField('charges')->type('text');
		$this->hasMany('healthCareApp/Beds','Ward_id');
		$this->hasMany('healthCareApp/Patient','Ward_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}