<?php

class page_healthCareApp_page_owner_hosconfig extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

		$form=$this->add('Form');
		$hosconfig=$this->add('healthCareApp/Model_HosConfig');
		$hosconfig->tryLoadAny();
		$form->setModel($hosconfig);

		$form->addSubmit('Update');

		if($form->isSubmitted()){
			$form->update();

			$form->js()->univ()->successMessage("Done")->execute();
		}
	}
}