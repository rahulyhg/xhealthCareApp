<?php

class page_healthCareApp_page_owner_main extends page_componentBase_page_owner_main{
	function init(){
		parent::init();
		 $this->h1->add('H1')->setElement('a')
		 ->setAttr('href','?page=healthCareApp_page_owner_main')
		 ->set($this->component_namespace);

		$menu=$this->add('Menu');
		$menu->addMenuItem('healthCareApp_page_owner_hosconfig','Hospital Config');			
		$menu->addMenuItem('healthCareApp_page_owner_department','Department');			
		$menu->addMenuItem('healthCareApp_page_owner_beds','Beds');
		$menu->addMenuItem('healthCareApp_page_owner_post','Post');
		//$menu->addMenuItem('healthCareApp_page_owner_roomcategory','Roomcategory');
		$menu->addMenuItem('healthCareApp_page_owner_services','Services');
		$menu->addMenuItem('healthCareApp_page_owner_staff','Staff');
		$menu->addMenuItem('healthCareApp_page_owner_treatment','Treatment');
		$menu->addMenuItem('healthCareApp_page_owner_ward','Ward');
		$menu->addMenuItem('healthCareApp_page_owner_attendance','Attendance');
		$menu->addMenuItem('healthCareApp_page_owner_patient','Patient');
		$menu->addMenuItem('healthCareApp_page_owner_assignpatientstostaff','Assign patients to staff');
		$menu->addMenuItem('healthCareApp_page_owner_report','Report');
		



	}
}