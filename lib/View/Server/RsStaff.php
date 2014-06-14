<?php
namespace healthCareApp;

class View_Server_RsStaff extends \View{
	function init(){
		parent::init();

		//todo get list of all doctor in our hospital 
		$btn_doctor=$this->add('Button')->set('View List Of Doctors in Our Hospital');
		
		$this->add('HR');
		$doctor=$this->add('healthCareApp/Model_Staff');	
		$doctor->addCondition('type','doctor');

		$form1=$this->add('Form');
		$form1_field=$form1->addField('autocomplete/Basic','search');
		$form1_field->setModel($doctor);


		$grid1=$this->add('Grid');
		if($_GET['name'])
			$doctor->addCondition('id',$_GET['name']);
		$grid1->setModel($doctor,array('name','phone_no','area_of_specialization','email','location_and_Duration_Of_OPD'));
			
		if($form1->isSubmitted()){
			$grid1->js()->reload(array('name'=>$form1['search']))->execute();
		}	
		// $grid1->addQuickSearch(array('name'));
		$btn_doctor->js('click',$grid1->js()->toggle());

		//todo generate list of present doctor today
		$btn_dr_present=$this->add('Button')->set('View list Of Doctors Present Today')->setStyle(array("margin-right"=>"60px"));
		$this->add('HR');
		$doctor=$this->add('healthCareApp/Model_Staff');	
		$dr_present=$doctor->join('healthCareApp_attendance.staff_id','id');
		$dr_present->addField('is_present');	
		$dr_present->addField('date');	
		$doctor->addCondition('type','doctor');
		$doctor->addCondition('is_present',true);
		$doctor->addCondition('date',date('Y-m-d'));
		$grid_dr_present=$this->add('Grid');
		$grid_dr_present->setModel($doctor,array('name','area_of_specialization','email','location_and_Duration_Of_OPD'));
		$btn_dr_present->js('click',$grid_dr_present->js()->toggle());


        
		//todo get list of all nurses in our hospital 
		$btn_nurse=$this->add('Button')->set('View List Of Nurses in Our Hospital');
		
		$this->add('HR');
		$nurse=$this->add('healthCareApp/Model_Staff');	
		$nurse->addCondition('type','nurse');

		$form2=$this->add('Form');
		$form2_field=$form2->addField('autocomplete/Basic','search');
		$form2_field->setModel($nurse);

		$grid2=$this->add('Grid');
		if($_GET['name'])
			$nurse->addCondition('id',$_GET['name']);
		$grid2->setModel($nurse,array('name','phone_no','email','location_and_Duration_Of_OPD'));
		
		if($form2->isSubmitted()){
			$grid2->js()->reload(array('name'=>$form2['search']))->execute();
		}	

		$btn_nurse->js('click',$grid2->js()->toggle());




		//todo generate list of present Nurses today
		
		$btn_nr_present=$this->add('Button')->set('View list Of Nurses Present Today')->setStyle(array("margin-right"=>"60px"));
		$this->add('HR');
		$nurse=$this->add('healthCareApp/Model_Staff');	
		$nr_present=$nurse->join('healthCareApp_attendance.staff_id','id');
		$nr_present->addField('is_present');	
		$nr_present->addField('date');	
		$nurse->addCondition('type','nurse');
		$nurse->addCondition('is_present',true);
		$nurse->addCondition('date',date('Y-m-d'));
		$grid_nr_present=$this->add('Grid');
		$grid_nr_present->setModel($nurse,array('name','area_of_specialization','email','location_and_Duration_Of_OPD'));
		$btn_nr_present->js('click',$grid_nr_present->js()->toggle());


		


	}
}

