<?php

class page_healthCareApp_page_owner_printbill extends \Page{
	function init(){
		parent::init();

$this->api->stickyGET('healthCareApp_bill_id');
$print=$this->add('healthCareApp/View_Print');
$bill=$this->add('healthCareApp/Model_Bill');
$print->setModel($bill);
$bill->load($_GET['healthCareApp_bill_id']);
		
	}
}