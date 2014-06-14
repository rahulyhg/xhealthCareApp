<?php

namespace healthCareApp;

class Model_Beds extends \Model_Table{
	public $table="healthCareApp_bed";
	function init(){
		parent::init();

		$this->hasOne('healthCareApp/Ward','ward_id');
		//$this->hasOne('healthCareApp/Roomcategory','roomcategory_id');
		$this->addField('bed_no');
		$this->addField('is_full')->type('boolean')->defaultValue(false);

		$this->hasMany('healthCareApp/Patient','patient_id');

		$this->add('dynamic_model/Controller_AutoCreator');

		
	}

	 function checkBedAvailablity($ward_id,$bed_no){
	 	
    	$this->addCondition('ward_id',$ward_id);
    	$this->addCondition('id',$bed_no);
    	$this->tryLoadAny();
	 	// throw new \Exception($this['ward_id']."".$this['name']." ".$this['ward'], 1);

    	if($this->loaded())
    		return true;
    	else
    		return false;
  }
}