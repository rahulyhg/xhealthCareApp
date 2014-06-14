<?php
namespace healthCareApp;

class View_Server_RsPtBill extends \View{
	function init(){
		parent::init();

		



		//todo get list of all doctor in our hospital 

		$btn=$this->add('Button')->set('Patient Billing ')->setStyle(array("margin-bottom"=>"5%"));
        $this->api->stickyGET('id');
        $form=$this->add('Form');
        $form->addField('line','bill_no');
        $form->addField('line','name');
        $form->addField('line','doctor_charges');
        $form->addField('line','medical_treatment_charges');
        $form->addField('line','service_treatment_charges');
        $form->addField('line','room_charges');
        $form->addField('line','hospital_charges');
        $form->addField('line','net_total_amount');

         $form->addSubmit('Save');

        $btn->js('click',$form->js()->toggle());


        $bill['bill_no']=$form['bill_no'];
        $bill['d_charges']=$form['d_charges'];
        $bill['medi_treatment_charges']=$form['medi_treatment_charges'];
        $bill['service_treatment_charges']=$form['service_treatment_charges'];
        $bill['room']=$form['room'];
        $bill['hospital']=$form['hospital'];
        $bill['net_total']=$form['net_total'];


         $form->addSubmit('Save');

        $btn->js('click',$form->js()->toggle());
        	
       
		
		


		


	}
}




		


	

