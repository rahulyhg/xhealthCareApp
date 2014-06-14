<?php

namespace healthCareApp;

class Plugins_AuthenticationCheck extends \componentBase\Plugin{
	public $namespace = 'healthCareApp';

	function init(){
		parent::init();

		$this->addHook('website-page-loaded',array($this,'AuthenticatePage'));
	}

	function AuthenticatePage($obj,&$page){
		
		$subpage = $_GET['subpage'];
		

		// ONLY WORKS FOR PAGES CONTAINS "xsocial-" IN PAGE
		// DO NOT CHECK FOR xsocial-login PAGE

		$allowed_page=array('xhealthcare-drlogin','xhealthcare-nslogin','xhealthcare-rslogin','xhealthcare-ptlogin');
		// $allowed_page=array('xhealthcare-nrlogin');

		if(strpos($subpage,	'xhealthcare-') === 0 AND !in_array($subpage, $allowed_page)){
			$allowed_page = array(
					'doctor'=>array('xhealthcare-drdashboard','xhealthcare-drprofile','xhealthcare-drattendance','xhealthcare-drleaves','xhealthcare-drschedule','xhealthcare-drpatients','xhealthcare-drnurseschedule'),
					// 'doctor'=>array(),
					'nurse'=>array('xhealthcare-nsdashboard','xhealthcare-nsprofile','xhealthcare-nsattendance','xhealthcare-nsleaves','xhealthcare-nsschedule'),
					'receptionist'=>array('xhealthcare-rsdashboard','xhealthcare-rsprofile','xhealthcare-rsattendance','xhealthcare-rsleaves','xhealthcare-rsstaff','xhealthcare-rspatients','xhealthcare-rsviewstaffschedule','xhealthcare-rsptbill'),
					'patient'=>array('xhealthcare-ptdashboard','xhealthcare-ptdetail','xhealthcare-ptbill'),
					'admin'=>array('xhealthcare-addashboard')
					);

			$login_page=array(
					'doctor'=>'xhealthcare-drdashboard',
					'nurse'=>'xhealthcare-nsdashboard',
					'receptionist'=>'xhealthcare-rsdashboard',
					'patient'=>'xhealthcare-ptdashboard',
					'admin'=>'xhealthcare-'
				);
			$model=array(
					'doctor'=>'Doctor',
					'nurse'=>'Nurse',
					'receptionist'=>'Receptionist',
					'patient'=>'Patient',
					'admin'=>'admin'
					
				);

			// IF session has logged_in_user value meanse user is there
			// load auth in api->xsocialauth and login this user
			$logged_in_user = $this->api->recall('logged_in_user',false);
			$type_of_user = $this->api->recall('type_of_user',false);
			if(!$logged_in_user){
				if(in_array($subpage, $allowed_page['doctor'])){
					$this->api->redirect($this->api->url(null,array('subpage'=>$login_page['doctor'])));
				}

				if(in_array($subpage, $allowed_page['nurse'])){
					$this->api->redirect($this->api->url(null,array('subpage'=>$login_page['nurse'])));
				}

				if(in_array($subpage, $allowed_page['receptionist'])){
					$this->api->redirect($this->api->url(null,array('subpage'=>$login_page['receptionist'])));
				}

				if(in_array($subpage, $allowed_page['patient'])){
					$this->api->redirect($this->api->url(null,array('subpage'=>$login_page['patient'])));
				}
				
				$this->api->redirect($this->api->url(null,array('subpage'=>'home')));
			}
			
			if(!in_array($subpage, $allowed_page[$type_of_user])){				
				$this->api->redirect($this->api->url(null,array('subpage'=>$login_page[$type_of_user])));
			}

			$xhealthCareAppauth =$this->add('BasicAuth',array('is_default_auth'=>false));
			$xhealthCareAppauth->setModel('healthCareApp/'.$model[$type_of_user],'email','password');
			// throw new \Exception($xhealthCareAppauth['name'], 1);
			
			$this->api->xhealthCareAppauth = $xhealthCareAppauth;
				
			// TODO :: Set cu_id = null when logout

			$xhealthCareAppauth->login($logged_in_user);

		}
	}

	function getDefaultParams($new_epan){}
}