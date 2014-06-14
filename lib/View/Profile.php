<?php

namespace healthCareApp;

class View_Profile extends \View{
	function init(){
		parent::init();
		
		// $this->add('healthCareApp/Model_Do')->set('Admin Login');
		// $Doctor=$this->add('healthCareApp/Model_Doctor');
		// $Doctor->addCondition("id",1);
		// throw new \Exception($Doctor['name']);
		
	}

	function defaultTemplate(){
		$l=$this->api->locate('addons',__NAMESPACE__, 'location');
		$this->api->pathfinder->addLocation(
			$this->api->locate('addons',__NAMESPACE__),
			array(
		  		'template'=>'templates',
		  		'css'=>'templates/css'
				)
			)->setParent($l);
		return array('view/healthcare-profile');
	}
}