<?php

namespace healthCareApp;

class Model_Staff extends \Model_Table{
	public $table="healthCareApp_staff";
	function init(){
		parent::init();

        $this->hasOne('healthCareApp/Post','post_id');
       // $this->hasOne('healthCareApp/Salaries','salaries_id');
        $this->addField('name');
        $this->addField('designation');
        $this->addField('gender')->enum(array('male','female'));
        $this->addField('location');
        $this->addField('age');
        $this->addField('dob');
        $this->addField('current_address');
        $this->addField('permanent_address');
        $this->addField('phone_no');
        $this->addField('area_of_specialization')->enum(array('Allergy and Immunology','Anesthesiology','Cardiology','Cardiovascular surgery','Clinical laboratory sciences','Dermatology','Front desk staff','Emergency medicine','Endocrinology','Family Medicine','Forensic Medicine','Forensic Medicine','Gastroenterology','General surgery','Geriatrics','Gynecology','Hepatology','Infectious disease','Intensive care medicine','Medical research','Nephrology','Neurology','Neurosurgery','Obstetrics and gynecology','Oncology','Ophthalmology','ral and maxillofacialO','surgery','Orthopedic surgery','Otorhinolaryngology, or ENT','Palliative care','Pathology','Plastic surgery','Psychiatry','Pulmonology','Radiology','Rheumatology','Stomatology','Surgical oncology','Thoracic surgery','Transplant surgery','Ugent rCare Medicine','Urology','Vascular surgery'));  
        $this->addField('accomplishment_Awards');
        $this->addField('education');
        $this->addField('experience');
        $this->addField('membership');
        $this->addField('location_and_Duration_Of_OPD');
        $this->addField('email');
        $this->addField('password')->type('password');
        $this->addField('type')->enum(array('doctor','nurse','receptionist'));
       	$this->add('filestore/Field_Image','img_id');
        $this->hasMany('healthCareApp/Attendance','staff_id');
        $this->hasMany('healthCareApp/Doctor','staff_id');
        // $this->hasMany('healthCareApp/Patientstaff','staff_id');
		$this->hasMany('healthCareApp/Schedule','staff_id');

		$this->add('dynamic_model/Controller_AutoCreator');
	}

    
    
}