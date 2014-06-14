<?php

namespace healthCareApp;

class Model_Attendance extends \Model_Table{
	public $table="healthCareApp_attendance";
	function init(){
		parent::init();
		

		$this->hasOne('healthCareApp/Staff','staff_id');
		$this->hasOne('healthCareApp/Post','post_id')->system(true);
        $this->addField('date')->type("date");
        $this->addField('is_present')->type("boolean")->defaultValue(false);
        $this->addField('leave_type')->enum(array('CL','PL'));

        $this->addExpression('no_of_cl_allowed')->set(function($m,$q){
        	return $m->refSQL('post_id')->fieldQuery('leaves_allowed');
        });
        


        
        $this->addHook('beforeSave',$this);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function beforeSave(){
		$this['post_id']=$this->ref('staff_id')->ref('post_id')->get('id');
	}

	function swap_attendance($attn){

		$old_att=$this->add('healthCareApp/Model_Attendance');
		$old_att->load($attn);
		$old_att['is_present']=!$old_att['is_present'];
		if($old_att)
			$old_att['leave_type']="";
		else
			$old_att['leave_type']="CL";
		$old_att->save();
	}

	function mark_cl($attn){

		$old_att=$this->add('healthCareApp/Model_Attendance');
		$old_att->load($attn);
		$old_att['leave_type']="CL";
		$old_att['is_present']=false;
		$old_att->save();
	}

	function mark_pl($attn){

		$old_att=$this->add('healthCareApp/Model_Attendance');
		$old_att->load($attn);
		$old_att['leave_type']="PL";
		$old_att['is_present']=false;
		$old_att->save();
	}
	

}