<?php

namespace healthCareApp;

class Model_Billservices extends \Model_Table{
	public $table="healthCareApp_billservices";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/Bill','bill_id');
        $this->hasOne('healthCareApp/Service','service_id');
      
        $this->addField('service_charges');

	
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}