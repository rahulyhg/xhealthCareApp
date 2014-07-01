<?php
namespace healthCareApp;

class View_Server_RsPtBill extends \View{
    function init(){
        parent::init();

        
        $this->api->stickyGET('healthCareApp_bill_id');
        
        $bill=$this->add('healthCareApp/Model_Bill');
        if($_GET['healthCareApp_bill_id'])
            $bill->load($_GET['healthCareApp_bill_id']);

        $cols=$this->add('Columns');
        $col1=$cols->addColumn(6);
        $col3=$cols->addColumn(12);
        $col2=$cols->addColumn(5);
        
        
        $btn=$col1->add('Button')->set('Patient Billing ')->setStyle(array("margin-bottom"=>"5%"));
        $btn1=$col2->add('Button')->set('Patient Already Registered')->setStyle(array("margin-bottom"=>"5%"));
        $form=$col1->add('Form');

        
        $grid=$col3->add('Grid');
        $grid->setModel($bill);
        $grid->addColumn('button','print');          
        $grid->addColumn('button','edit');          
        $grid->addColumn('button','delete');
        
        if($_GET['print']){
        $this->js()->univ()->newWindow($this->api->url("healthCareApp_page_owner_printbill",array('healthCareApp_bill_id'=>$_GET['print'],'cut_page'=>1)),null,'height=689,width=1246,scrollbar=1')->execute();
        }

        if($_GET['edit']){
        $this->js()->reload(array('healthCareApp_bill_id'=>$_GET['edit']))->execute();
        }           
        if($_GET['delete']){
        $bill=$this->add('healthCareApp/Model_Bill');
        $bill->load($_GET['delete']);
        $bill->delete();
        $grid->js(null,$grid->js()->univ()->successMessage('Delete Succesfully'))->reload()->execute();
        }


        $form->setModel($bill);
        
        $form->addSubmit('Save');

         if($form->isSubmitted()){
            $form->update();
            $form->js(null,$grid->js()->reload())->reload()->execute();
         }

        $btn->js('click',$form->js()->toggle());


        $patient=$this->add('healthCareApp/Model_Patient');
        $patient->title_field='code';

        $patient_form=$col2->add('Form');
        $patient_code=$patient_form->addField('autocomplete/Basic','patient_code');
        $patient_code->setModel($patient);

        $detail=$col2->add('healthCareApp/View_Detail');
        
        // $grid=$col2->add('Detail');         
        if($_GET['code']){
            $patient->addCondition('id',$_GET['code']);
            $patient->tryLoadAny();
        }else{
            $patient->addCondition('id',-1);
            $detail->js(true)->hide();
        }

        $detail->setModel($patient);

        $btn1->js('click',$patient_form->js()->toggle());
       
        if($patient_form->isSubmitted()){
            // throw new \Exception($patient_form['patient_code'], 1);
            $detail->js()->reload(array('code'=>$patient_form['patient_code']))->execute();
        }

        }
}




		


	


