<?php
class page_healthCareApp_page_owner_patient_servicesUsed extends page{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('healthCareApp/Patientservices');


		function page_servicesUsed()
	{

		$this->api->stickyGET('patient_id');
		$used=$this->add('healthCareApp/Model_Patientservices');
		$used->addCondition('patient_id',$_GET['patient_id']);
		$crud=$this->add('CRUD');
		$crud->setModel($used);
	}

	}
}