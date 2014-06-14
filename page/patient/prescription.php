<?php
class page_healthCareApp_page_owner_patient_prescription extends Page {
    function init(){
        parent::init();

        $this->api->stickyGET('patient_id');

        $prescription=$this->add('healthCareApp/Model_Prescription');
        $prescription->addCondition('patient_id',$_GET['patient_id']);

        $grid=$this->add('Grid');

        $grid->setModel($prescription);



    }
}
