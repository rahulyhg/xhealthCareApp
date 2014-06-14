<?php

class page_healthCareApp_page_owner_patientinfo extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

			
		
		$tab=$this->add('Tabs');
		$tab->addTabURL('healthCareApp_page_owner_patient','Patients');
		
	}
}