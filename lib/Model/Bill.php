<?php

namespace healthCareApp;

class Model_Bill extends \Model_Table{
	public $table="healthCareApp_bill";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/HosConfig','hosconfig_id');
        $this->addCondition('hosconfig_id',1);
        $this->addField('bill_no');
        $this->addField('d_charges')->caption('Doctor Charges');
        $this->addField('medi_treatment_charges')->caption('Medical Treatment Charges');
        $this->addField('service_treatment_charges')->caption('Service Treatment Charges');
        $this->addField('room')->caption('Room Charges');
        $this->addField('hospital')->caption('Hospital Charges');
        $this->addField('net_total')->caption('Net Total Amount');
        
 
		$this->hasMany('healthCareApp/Billservices','bill_id'); 
		$this->hasMany('healthCareApp/Patient','bill_id'); 

		// $this->addExpression('net_Amount')->set(function($m,$q){
		// 	return $m->refSQL('healthCareApp/Billservices')->sum('service_charges');
		// });
		$this->add('dynamic_model/Controller_AutoCreator');
		
		
	}
}