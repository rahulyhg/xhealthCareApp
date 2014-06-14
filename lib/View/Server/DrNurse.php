<?php
namespace healthCareApp;

class View_Server_DrNurse extends \View{
	function init(){
		parent::init();

		// $form=$this->add('Form');
		$schedule=$this->add('healthCareApp/Model_Schedule');
		$staff=$schedule->join('healthCareApp_staff.id','staff_id');
		$att=$staff->join('healthCareApp_attendance.staff_id','id');
		$att->addField('is_present');
		$att->addField('attendance_date','date');
		$staff->addField('type');
		$schedule->addCondition('type','nurse');
		$schedule->addCondition('is_present',true);
		$schedule->addCondition('date',date('Y-m-d'));

		// throw new \Exception($staff->id, 1);
		

		
		$btn=$this->add('Button')->set('View list Of Nurses Present Today')->setStyle(array("margin-right"=>"60px"));
		$this->add('HR');
		$nurse=$this->add('healthCareApp/Model_Staff');	
		$att=$nurse->join('healthCareApp_attendance.staff_id','id');
		$att->addField('is_present');	
		$att->addField('date');	
		$nurse->addCondition('type','nurse');
		$nurse->addCondition('is_present',true);
		$nurse->addCondition('date',date('Y-m-d'));
		$grid=$this->add('Grid');
		$grid->setModel($nurse,array('name'));
		
		$btn->js('click',$grid->js()->toggle());
		$btn1=$this->add('Button')->set('View Nurse Schedule');

		
		$this->add('HR');
		$grid=$this->add('Grid');
		$grid->setModel($schedule);
		$btn1->js('click',$grid->js()->toggle());
		//$btn1->js('click',$this->js()->univ()->frameURL('Show',$this->api->url('healthCareApp_page_nurseschedule'),array('width'=>'600px')));


	}
}

