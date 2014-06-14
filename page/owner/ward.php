<?php
class page_healthCareApp_page_owner_ward extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

		$crud=$this->add('CRUD');
		$crud->setModel('healthCareApp/Ward');

	}
}