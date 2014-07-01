<?php

namespace healthCareApp;

class Model_Bill extends \Model_Table{
	public $table="healthCareApp_bill";
	function init(){
		parent::init();

        $this->addField('code');
        $this->addField('date')->type('date');
        $this->addField('search_string')->system(true);
        $this->addField('discharge')->type('boolean');
        $this->addField('d_charges')->caption('Doctor Charges');
        $this->addField('medi_treatment_charges')->caption('Medical Treatment Charges');
        $this->addField('service_treatment_charges')->caption('Service Treatment Charges');
        $this->addField('room')->caption('Room Charges');
        $this->addField('hospital')->caption('Hospital Charges');
        
 		$this->addExpression('net_total')->set('d_charges+medi_treatment_charges+service_treatment_charges+room+hospital');

		$this->hasMany('healthCareApp/Billservices','bill_id'); 
		$this->hasMany('healthCareApp/Patient','bill_id'); 
		
	}
}
