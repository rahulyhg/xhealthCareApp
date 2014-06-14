<?php
namespace healthCareApp;

class View_Server_DrPatients extends \View{
	function init(){
		parent::init();

		// $form=$this->add('Form');
		$patient=$this->api->xhealthCareAppauth->model->ref('healthCareApp/Assignpatients');				
		
		$patient->setOrder('id','desc');

		$btn=$this->add('Button')->set('View Overall Patients List')->setStyle(array("margin-right"=>"60px"));
		$this->add('HR');
		$grid=$this->add('Grid');
		$grid->setModel($patient);
		$btn->js('click',$grid->js()->toggle());
		
		$grid->addColumn('Button','services');

		if($_GET['services']){
			
			$this->js()->univ()->frameURL('Service Or Tretment Apply',$this->api->url('healthCareApp_page_patientservice',array('patient_id'=>$_GET['services'])))->execute();
		}


	}
}

