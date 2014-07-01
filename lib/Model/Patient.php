<?php

namespace healthCareApp;

class Model_Patient extends \Model_Table{
	public $table="healthCareApp_patient";
	function init(){
		parent::init();


        $this->hasOne('healthCareApp/Department','department_id');
        $this->hasOne('healthCareApp/Bill','bill_id');
        $this->hasOne('healthCareApp/Ward','ward_id');
        $this->hasOne('healthCareApp/Beds','bed_id');
       $this->addField('search_string')->system(true);
        $this->addField('name')->caption('Patient name');
        $this->addField('code')->caption('Patient Code');
        $this->addField('age')->caption('Patient Age');
        $this->addField('gender')->enum(array('male','female'));
        $this->addField('p_phone')->caption('Patient phone ');
        $this->addField('p_dob')->caption('Patient DOB');
        $this->addField('p_age')->caption('Patient Age');
        $this->addField('p_address')->caption('Patient Address');
        $this->addField('email');
        $this->addField('relatives_name');
        $this->addField('relatives_address');
        $this->addField('relatives_phone_no')->type('int');
        $this->addField('gaurdians_name');
        $this->addField('gaurdians_address');
        $this->addField('gaurdians_phone_no');
        $this->addField('password')->type('password');
        $this->addField('p_md')->caption('Medical Diagnosis');
        $this->hasOne('healthCareApp/Doctor','doctor_id');
        $this->addField('p_pp')->caption('Referring Physician phone');
        $this->addField('patient')->caption('Patient Id');
        $this->addField('type')->enum(array('OPD','IPD'));
        $this->addField('is_active')->type('boolean');
    $this->hasMany('healthCareApp/Patientservices','patient_id');
		$this->hasMany('healthCareApp/Prescription','patient_id');
		$this->add('dynamic_model/Controller_AutoCreator');
	}  


	 
 function tryLogin($email,$password){

    $doctor=$this->add('healthCareApp/Model_Patient');

    $doctor->addCondition('email',$email); 
    $doctor->addCondition('password',$password);
    $doctor->tryLoadAny();
    if($doctor->loaded()){
      $this->api->memorize('logged_in_user',$email);
      $this->api->memorize('type_of_user','patient');
      return true;
      }
      else{
        $this->api->forget('logged_in_user',$email);
        $this->api->forget('type_of_user',$email);
        return false;
        
      }
  }
}
	 