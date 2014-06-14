<?php
namespace healthCareApp;

class View_Server_RsPatients extends \View{
	function init(){
		parent::init();

        $this->api->stickyGET('ward_id');
        $staff=$this->add('healthCareApp/Model_Staff');
        $staff->addCondition('type','doctor');
         
        $cols=$this->add('Columns');
        $col1=$cols->addColumn(6);
        $col2=$cols->addColumn(6);

        $code='p'.rand(100,1000);
       $btn=$col1->add('Button')->set('Patient Registration')->setStyle(array("margin-bottom"=>"5%"));
        $this->api->stickyGET('id');
        $form=$col1->add('Form');
        $form->addField('line','code')->set($code)->validateNotNull('Fill Form Properly');
        $form->addField('line','name')->validateNotNull('Fill Form Properly');
        $form->addField('Radio','gender')->setValueList(array('male'=>'male','female'=>'female'))->validateNotNull('Fill Form Properly');
        $form->addField('DatePicker','dob')->validateNotNull('Fill Form Properly');
        $form->addField('DropDown','age')->setValueList(array('00-10'=>'00-10','11-20'=>'11-20','21-30'=>'21-30','31-40'=>'31-40','41-50'=>'41-50','51-60'=>'51-60','61-70'=>'61-70','71-80'=>'71-80'))->setEmptyText('Select Age')->validateNotNull('Fill Form Properly');
        $form->addField('line','phone')->validateNotNull('Fill Form Properly');
        $form->addField('Text','address')->validateNotNull('Fill Form Properly');
        $form->addField('Radio','patient_type')->setValueList(array('OPD'=>'OPD','IPD'=>'IPD'))->validateNotNull('Fill Form Properly');
        $form->addField('line','email')->set($code.'@hc.com');
        $form->addField('password','password')->validateNotNull('Fill Form Properly');
        
        $form->addField('line','disease')->validateNotNull('Fill Form Properly');
        $md=$form->addField('line','medical_diagnosis')->validateNotNull('Fill Form Properly');
       $dr= $form->addField('DropDown','doctor')->setEmptyText('please select')->validateNotNull('Fill Form Properly')->validateNotNull('Fill Form Properly');
       $dr->setModel($staff);
        
        

        $form->add('H2')->set('Information Given By Whom');
        
        $check=$form->addField('checkbox','Patient itself');
        $check1=$form->addField('checkbox','Relative');
        $check2=$form->addField('checkbox','Guardian');


        
        
        
        $check1->js(true)->univ()->bindConditionalShow(array(
                                ""=>array(),
                                '*'=>array('Relatives_name','Relatives_address','Relatives_phone_no'),
                                'div.atk-row'));

        $form->addField('line','Relatives_name');
        $form->addField('text','Relatives_address');
        $form->addField('line','Relatives_phone_no');


        $check2->js(true)->univ()->bindConditionalShow(array(
                                ""=>array(),
                                '*'=>array('Gaurdians_name','Gaurdians_address','Gaurdians_phone_no'),
                                'div.atk-row'));

        $form->addField('line','Gaurdians_name');
        $form->addField('text','Gaurdians_address');
        $form->addField('line','Gaurdians_phone_no');


        $form->add('H2')->set('Patients Status');
        
        $admit_field=$form->addField('CheckBox','admit');

        $ward_field=$form->addField('DropDown','ward');
        $ward_field->setModel('healthCareApp/Ward');

        $bed_field=$form->addField('DropDown','bed_no');

         $beds=$this->add('healthCareApp/Model_Beds');
        $beds->addCondition('is_full',false);
        $beds->title_field="bed_no";
        // $ward->js( 'change' )->reload('bed_no')->execute();
        if($_GET['ward_id']){
            throw new \Exception($_GET['ward_id']);
            
            $beds->addCondition('ward_id',$_GET['ward_id']);
        }
            $bed_field->setModel($beds);

        $ward_field->js('change',$form->js()->atk4_form('reloadField','bed_no',array('ward_id'=>$bed_field->js()->val())));

        
        $admit_field->js(true)->univ()->bindConditionalShow(array(
                                ""=>array(),
                                '*'=>array('ward','bed_no'),
                                'div.atk-row'));
        $form->addSubmit('Register');

        $btn->js('click',$form->js()->toggle());

        if($form->isSubmitted()){

        	$patient=$this->add('healthCareApp/Model_Patient');
            $patient->addCondition('code',$form['code']);
            $patient->tryLoadAny();
            
            if($patient->loaded())
                $form->displayError('code','This Code is Allready Given');
            $bed=$this->add('healthCareApp/Model_Beds');
            $bed->load($form['bed_no']);

            if(!$bed->checkBedAvailablity($form['ward'],$form['bed_no']))
                $form->displayError('bed_no','This bed is not Avialable in selected ward or room');

        	$patient['name']=$form['name'];
        	$patient['gender']=$form['gender'];
        	$patient['p_phone']=$form['phone'];
                $patient['p_dob']=$form['dob'];
        	$patient['p_age']=$form['age'];
        	$patient['email']=$form['email'];
        	$patient['p_address']=$form['p_address'];
        	$patient['password']=$form['password'];
            $patient['p_md']=$form['p_md'];
        	$patient['code']=$form['code'];
        	//$patient['p_pp']=$form['p_pp'];
            $patient['Radio']=$form['patient_type'];
            if($form['admit']){
            $patient['ward_id']=$form['ward'];
            $patient['bed_id']=$form['bed_no'];
            }
            $patient['relatives_name']=$form['Relatives_name'];
            $patient['relatives_address']=$form['Relatives_address'];
        	$patient['relatives_phone_no']=$form['Relatives_phone_no'];
        	$patient['gaurdians_name']=$form['Gaurdians_name'];
            $patient['gaurdians_address']=$form['Gaurdians_address'];
            $patient['gaurdians_phone_no']=$form['Gaurdians_phone_no'];
            
            $patient->save();

            $bed['is_full']=true;
            $bed->save();

            $assign=$this->add('healthCareApp/Model_Assignpatients');
            $assign['doctor_id']=$form['doctor'];
            $assign['patient_id']=$patient->id;
            $assign['assign_on']=date('Y-m-d');
            $assign['disease']=$form['disease'];
            $assign->save();
            $form->js()->univ()->redirect($this->api->url(null,array('subpage=>xhealthcare-rspatients')))->execute();
        	
        }

        $staff=$this->add('healthCareApp/Model_Patient');
        
        $btn1=$col2->add('Button')->set('Patient Already Registered')->setStyle(array("margin-bottom"=>"5%"));
        $patient=$this->add('healthCareApp/Model_Patient');
        $patient->title_field='code';

        $patient_form=$col2->add('Form');
        $patient_code=$patient_form->addField('autocomplete/Basic','patient_code');
        $patient_code->setModel($patient);

        $detail=$col2->add('healthCareApp/View_Detail');
        
        // $grid=$col2->add('Detail');         
        if($_GET['code']){
            $patient->addCondition('id',$_GET['code']);
            $patient->tryLoadAny();
        }else{
            $patient->addCondition('id',-1);
            $detail->js(true)->hide();
        }

        $detail->setModel($patient);

        $btn1->js('click',$patient_form->js()->toggle());
       
        if($patient_form->isSubmitted()){
            // throw new \Exception($patient_form['patient_code'], 1);
            $detail->js()->reload(array('code'=>$patient_form['patient_code']))->execute();
        }

		}


	}


