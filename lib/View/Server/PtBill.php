<?php
namespace healthCareApp;

class View_Server_PtBill extends \View{
	function init(){
		parent::init();

		//todo get list of all doctor in our hospital 

        $cols=$this->add('Columns');
        $col1=$cols->addColumn(5);
        $col2=$cols->addColumn(5);




        $this->api->stickyGET('healthCareApp_bill_id');
        

        $btn1=$col1->add('Button')->set('Bill Details');
        $detail=$col1->add('healthCareApp/View_Print');         
       
        $p=$this->add('healthCareApp/Model_Bill');
        // $p->addCondition('code',$this->api->xhealthCareAppauth->model->id);
        // $p->tryLoadAny();
        $p->loadAny($_GET['healthCareApp_bill_id']);
                
        
        // // throw new \Exception($this->api->xhealthCareAppauth->model->id, 1);
        $detail->setModel($p);
        $btn1->js('click',$detail->js()->toggle());
        $detail->js(true)->hide();   
        
     }
}



        
  

        



        

        

