<?php

class page_healthCareApp_page_owner_bill extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('healthCareApp/Department',array('name','overview','consultants'),array('name','overview','consultants'));
		
		//$crud->addRef('healthCareApp/Billservices');
	}
}