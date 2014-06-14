<?php

namespace healthCareApp;

class Model_Roomcategory extends \Model_Table{
	public $table="healthCareApp_roomcategory";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/HosConfig','hosconfig_id');
        $this->addField('name');
		$this->hasMany('healthCareApp/Beds','roomcategory_id');
        $this->addField('charges')->type('text');
		$this->addCondition('hosconfig_id',1); 
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}