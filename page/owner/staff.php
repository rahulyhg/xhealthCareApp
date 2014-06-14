<?php
class page_healthCareApp_page_owner_staff extends page_healthCareApp_page_owner_main{
	function page_index(){
		// parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('healthCareApp/Model_Staff');
		// $crud->addRef('healthCareApp/Schedule',array('label'=>'Schedule'));
		if($crud->grid){
			$crud->grid->addColumn('expander','schedule');
		}
		

	}
}