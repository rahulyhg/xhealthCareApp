<?php
namespace healthCareApp;

class View_Server_DrAttendance extends \View{
	function init(){
		parent::init();

		$Doctor=$this->add('healthCareApp/Model_Doctor');
		
		$attendance=$this->api->xhealthCareAppauth->model->ref('healthCareApp/Attendance');
        $attendance->setOrder('id','desc');
		$btn=$this->add('Button')->set('View Attendance');
		$this->add('HR');
		$grid=$this->add('Grid');
		$grid->setModel($attendance);
		// $this->js(true,$grid->js()->hide());
		$btn->js('click',$grid->js()->toggle());

		//$grid->addColumn('button','done');

		// if($_GET['done']){

		// 	$attendance->load($_GET['done']);
		// 	$attendance['is_work_done']=!$schedule['is_work_done'];
		// 	$attendance->save();
		// 	$grid->js()->reload()->execute();
		// }
	}
}

