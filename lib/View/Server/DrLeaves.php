<?php
namespace healthCareApp;

class View_Server_DrLeaves extends \View{
	function init(){
		parent::init();

		// $form=$this->add('Form');
		// $Doctor=$this->add('healthCareApp/Model_Doctor');
		$staff=$this->api->xhealthCareAppauth->model;
		$att=$staff->join('healthCareApp_attendance.staff_id','id');
		
		$total_leaves=$staff->ref('post_id')->get('leaves_allowed');
		$this->add('H1')->set('Total Leave Allowed'." "."$total_leaves");
		// $col1->add('H1')->set($total_leaves);
		
		

		$staff->addCondition('id',$this->api->xhealthCareAppauth->model->id);
		$att->addField('is_present');
		$att->addField('leave_type');
		$staff->addCondition('is_present',false);
		$staff->addCondition('leave_type','CL');
		$total_taken_leaves=$staff->count()->getOne();

		$cols=$this->add('Columns');
		$col1=$cols->addColumn(6);
		$col2=$cols->addColumn(6);
		//$col3=$cols->addColumn(3);
		$btn=$col1->add('Button')->set('View already taken leaves')->setStyle(array("margin-right"=>"60px"));
		// $leaves=$staff->ref('post_id')->get('leaves_allowed');
		$btn1=$col2->add('Button')->set('View Remainning Leaves');
		$taken_leaves=$col1->add('H1');
		$taken_leaves->set($total_taken_leaves);
		$btn->js('click',$taken_leaves->js()->toggle());
		$taken_leaves->js(true)->hide();

		$remaining_leaves=$total_leaves-$total_taken_leaves;
		$remain_leaves=$col2->add('H1');
		$remain_leaves->set($remaining_leaves);
		$btn1->js('click',$remain_leaves->js()->toggle());
		$remain_leaves->js(true)->hide();

	}
}

