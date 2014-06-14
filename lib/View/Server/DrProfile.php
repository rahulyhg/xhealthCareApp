<?php
namespace healthCareApp;

class View_Server_DrProfile extends \View{
	function init(){
		parent::init();

		$form=$this->add('Form');
		// $Doctor=$this->add('healthCareApp/Model_Doctor');
		
		// throw new \Exception($this->api->xhealthCareAppauth->model['name'], 1);
		
		// $Doctor->load($this->api->xhealthCareAppauth->model->id);
		$form->setModel($this->api->xhealthCareAppauth->model,array('password'));
		//
		$form->addField('password','re_password');

		$form->addSubmit('Update');

		$btn=$this->add('Button')->set('View Profile');

		$profile=$this->add('healthCareApp/View_Profile');

		
		
		// throw new \Exception($this->api->xhealthCareAppauth->model['name'], 1);
		$profile->setModel($this->api->xhealthCareAppauth->model);

		$btn->js('click',$profile->js()->toggle());


		if($form->isSubmitted()){
			$form->update();

			if($form['password']!=$form['re_password'])
				$form->displayError('re_password','please recheck your password');


			$form->js(null,$form->js()->reload())->univ()->successMessage("Updated")->execute();
		}

	}
}

