<?php
class page_healthCareApp/printbill extends Page {
    function init(){
        parent::init();

        $print=$this->add('healthCareApp/View_Print');

		$print->setModel($this->add('healthCareApp/Model_Bill')->loadAny($_GET['healthCareApp_bill_id']));
		

    }
}
