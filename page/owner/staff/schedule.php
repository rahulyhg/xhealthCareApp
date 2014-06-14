<?php
class page_healthCareApp_page_owner_staff_schedule extends Page{
	function init(){
		parent::init();

		// $crud=$this->add('CRUD');
		// $crud->setModel('healthCareApp/Schedule');


			$this->api->stickyGET('healthCareApp_staff_id');
			$schedule=$this->add('healthCareApp/Model_Schedule');
			$schedule->addCondition('staff_id',$_GET['healthCareApp_staff_id']);
			$crud=$this->add('CRUD');
			$crud->setModel($schedule);
	}
}
