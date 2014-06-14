<?php
class page_healthCareApp_page_owner_assignpatientstostaff extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('healthCareApp/Assignpatients');

	}
}