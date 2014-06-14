<?php
namespace healthCareApp;

class View_Server_PtDetail extends \View{
    function init(){
        parent::init();

        //todo get list of all doctor in our hospital 
        //$btn_doctor=$this->add('Button')->set('View Patient Billing Details');
        $cols=$this->add('Columns');
        $col1=$cols->addColumn(5);
        $col2=$cols->addColumn(5);


        $btn1=$col1->add('Button')->set('Patient Details');
        $detail=$col1->add('healthCareApp/View_Detail');         
        // $detail->js(true)->hide();
        $p=$this->add('healthCareApp/Model_Patient');
        $p->addCondition('id',$this->api->xhealthCareAppauth->model->id);
        $p->tryLoadAny();
        // // throw new \Exception($this->api->xhealthCareAppauth->model->id, 1);
        $detail->setModel($p);
        $btn1->js('click',$detail->js()->toggle());
        

        $btn2=$col2->add('Button')->set('Patients Prescription');
		$pre=$col2->add('Grid');
        $pre->js(true)->hide();   
        $pre->setModel($this->api->xhealthCareAppauth->model->ref('healthCareApp/Prescription'));
        $btn2->js('click',$pre->js()->toggle());
        



        

	
}
}
