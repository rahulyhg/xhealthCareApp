<?php

namespace healthCareApp;

class View_Server_PrintBill extends \View{
	function init(){
		parent::init();

		$bill=$this->add('healthCareApp/Model_Bill');
		if($_GET['edit_info'])
            $bill->load($_GET['edit_info']);

        $grid=$this->add('Grid');
        $grid->setModel($bill);
        // $grid->addClass('shahi');
        // $grid->js('shahievent')->reload();
        
        $grid->addColumn('button','print');          
        $grid->addColumn('button','edit');          
        $grid->addColumn('button','delete');
        
        if($_GET['print']){
        $grid->js()->univ()->newWindow($this->api->url("healthCareApp_page_owner_printbill",array('healthCareApp_bill_id'=>$_GET['print'],'cut_page'=>1)),null,'height=689,width=1246,scrollbar=1')->execute();
        }

        if($_GET['edit']){
        $grid->js()->reload(array('edit_info'=>$_GET['edit']))->execute();
        }           
        if($_GET['delete']){
        $bill=$this->add('healthCareApp/Model_Bill');
        $bill->load($_GET['delete']);
        $bill->delete();
        $grid->js(null,$grid->js()->univ()->successMessage('Delete Succesfully'))->reload()->execute();
        }
	}
}
