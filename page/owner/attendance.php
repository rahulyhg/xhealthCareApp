<?php
class page_healthCareApp_page_owner_attendance extends page_healthCareApp_page_owner_main {
     //main page extend problm.....tab redundancy 
	function init()
	{
		parent::init();

		$this->api->stickyGET('date');

		$form=$this->add('Form');
		$form->addField('DatePicker','date');
		$form->addSubmit('Get List');

		$grid=$this->add('Grid');
		$attendance=$this->add('healthCareApp/Model_Attendance');

		if($_GET['date']){
			$attendance->addCondition('date',$_GET['date']);
			$new_att=$this->add('healthCareApp/Model_Attendance');
			$staff=$this->add('healthCareApp/Model_Staff');

			foreach ($staff as $junk) {
				$new_att=$staff->ref('healthCareApp/Attendance');		
			if($staff->ref('healthCareApp/Attendance')->count()->getOne()<=0){
				$new_att['staff_id']=$staff->id;
				$new_att['date']=$_GET['date'];
				$new_att->save();
				}

			$new_att->addCondition('date',$_GET['date']);
			$new_att->tryLoadAny();
			if(!$new_att->loaded()){

				$new_att->save();
			}


			}
		}else{
			$attendance->addCondition('id',-1);
			
		}

		// }else{
		// }
		$grid->setModel($attendance);


		$grid->addMethod('format_blank',function($g,$f){
			$a=$g->model->ref('post_id')->getField('leaves_allowed');
			// throw new \Exception($a['leaves_allowed'], 1);
			
			if($a< $g->model->addCondition('is_present',false)->addCondition('leave_type','CL')->count()->getOne())
				
				$g->current_row[$f]='';
			});

		$grid->addMethod('format_taken_leave',function($g,$f){
			$taken_leave=$g->model->addCondition('staff_id',$g->model->ref('staff_id')->get('id'))->addCondition('leave_type','CL')->count()->getOne();
			// throw new \Exception($a['leaves_allowed'], 1);
				// throw new \Exception($taken_leave, 1);
				
			$g->current_row[$f]=$g->current_row['no_of_cl_allowed']-$taken_leave;


			});


		if($_GET['swap_attendance']){
			$attn=$this->add('healthCareApp/Model_Attendance');
			$attn->swap_attendance($_GET['swap_attendance']);
			$grid->js()->reload()->execute();
		}
		if($_GET['mark_cl']){
			$attn=$this->add('healthCareApp/Model_Attendance');
			$attn->mark_cl($_GET['mark_cl']);
			$grid->js()->reload()->execute();
		}

		if($_GET['mark_pl']){

			$attn=$this->add('healthCareApp/Model_Attendance');
			$attn->mark_pl($_GET['mark_pl']);
			$grid->js()->reload()->execute();
		}

		$grid->addColumn('taken_leave','remaining_cl');
		$grid->addColumn('button','swap_attendance','Mark Present');
		$grid->addColumn('button,blank','mark_cl');
		$grid->addColumn('button,blank','mark_pl');

		if($form->isSubmitted()){


			$grid->js()->reload(array('date'=>$form['date']))->execute();
		}

	}
}

