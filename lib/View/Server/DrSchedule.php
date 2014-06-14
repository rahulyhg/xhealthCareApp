<?php
namespace healthCareApp;

class View_Server_DrSchedule extends \View{
	function init(){
		parent::init();

		// $form=$this->add('Form');
		$Doctor=$this->add('healthCareApp/Model_Doctor');
		
		$schedule=$this->api->xhealthCareAppauth->model->ref('healthCareApp/Schedule');

		$btn=$this->add('Button')->set('View Todays Schedule');
		$this->add('HR');
		$grid=$this->add('Grid');
		$grid->setModel($schedule);
		// $this->js(true,$grid->js()->hide());
		$btn->js('click',$grid->js()->toggle());

		$grid->addColumn('button','done');

		if($_GET['done']){

			$schedule->load($_GET['done']);
			$schedule['is_work_done']=!$schedule['is_work_done'];
			$schedule->save();
			$grid->js()->reload()->execute();
		}
	}
}

