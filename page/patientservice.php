<?php
class page_healthCareApp_page_patientservice extends Page {
    function init(){
        parent::init();
        $this->api->stickyGET('patient_id');

        $ass=$this->api->xhealthCareAppauth->model->ref('healthCareApp/Assignpatients');
        $ass->load($_GET['patient_id']);
        
        $patient=$this->add('healthCareApp/Model_Patient');
        $patient->load($ass['patient_id']);

        $services=$this->add('healthCareApp/Model_Prescription');
        $services->addCondition('patient_id',$patient->id);
        $form=$this->add('Form');
        $form->setModel($services);
        $form->addSubmit('Save');
        $grid=$this->add('CRUD',array('allow_add'=>false,'allow_edit'=>false));

        if($form->isSubmitted()){
        	if($form['doctor_id']!=$this->api->xhealthCareAppauth->model->id)
        		$form->displayError('doctor_id','You can Not pricribe Other Doctor');
	        $form->update();

	        $form->js(null,$grid->js()->reload())->reload()->execute();
	    }



        $grid->setModel($services);



    }
}
