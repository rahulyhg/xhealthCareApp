<?php

class page_healthCareApp_page_owner_bill extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

		// $crud=$this->add('CRUD');
		// $crud->setModel('healthCareApp/Bill');		
		$crud1=$this->add('CRUD');
		$crud1->setModel('healthCareApp/Bill');		
		//$crud->addRef('healthCareApp/Billservices');
	}
}