<?php
class page_healthCareApp_page_owner_patient extends page_healthCareApp_page_owner_main{
	// function init(){
	// 	parent::init();
	function page_index(){


	

		$crud=$this->add('CRUD');
		$crud->setModel('healthCareApp/Patient');
		if($crud->grid)
		{
			$crud->grid->addColumn('expander','prescription');
		}

		// $crud->addRef('healthCareApp/Prescription',array('allow_add'=>false,'allow_del'=>false,'allow_edit'=>false));
      

	}

}