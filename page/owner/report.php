<?php
class page_healthCareApp_page_owner_report extends page_healthCareApp_page_owner_main{
	function init(){
		parent::init();

	    $tab=$this->add('Tabs');
	    $tab->addTab('Patient Type Report');

		// $opd=$this->add('healthCareApp/OPD');

		$form=$this->add('Form');
		$form->addField('dropdown','type')->setValueList(array('OPD'=>'OPD','IPD'=>'IPD'));
		// $opd->setModel('$opd');

		$form->addSubmit('Get List');

		$grid=$this->add('Grid');

		$patient=$this->add('healthCareApp/Model_Patient');

		if($_GET['type'])
			$patient->addCondition('type',$_GET['type']);

		$grid->setModel($patient);

		
		if($form->isSubmitted()){
			$grid->js()->reload(array('type'=>$form['type']))->execute();
         
	}
		}
}