<?php
namespace healthCareApp;

class View_Server_RsStSchedule extends \View{
	function init(){
		parent::init();

		

		$btn=$this->add('Button')->set('View Schedule Of Doctors Present Today');
		$this->add('HR');
		

		$schedule=$this->add('healthCareApp/Model_Schedule');
		$staff=$schedule->join('healthCareApp_staff.id','staff_id');
		$att=$staff->join('healthCareApp_attendance.staff_id','id');
		$att->addField('is_present');
		$att->addField('attendance_date','date');
		$staff->addField('type');
		$schedule->addCondition('type','doctor');
		$schedule->addCondition('is_present',true);
		$schedule->addCondition('date',date('Y-m-d'));



		$grid=$this->add('Grid');
		$grid->setModel($schedule);
		$btn->js('click',$grid->js()->toggle());




		$btn1=$this->add('Button')->set('View Schedule Of Nurses Present Today');
		$this->add('HR');
		

		$nr_schedule=$this->add('healthCareApp/Model_Schedule');
		$staff=$nr_schedule->join('healthCareApp_staff.id','staff_id');
		$att=$staff->join('healthCareApp_attendance.staff_id','id');
		$att->addField('is_present');
		$att->addField('attendance_date','date');
		$staff->addField('type');
		$nr_schedule->addCondition('type','nurse');
		$nr_schedule->addCondition('is_present',true);
		$nr_schedule->addCondition('date',date('Y-m-d'));



		$nr_grid=$this->add('Grid');
		$nr_grid->setModel($nr_schedule);
		$btn1->js('click',$nr_grid->js()->toggle());

	}
}

