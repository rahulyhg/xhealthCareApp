<?php

class page_healthCareApp_page_uninstall extends page_componentBase_page_uninstall{
	function init(){
		parent::init();

		$this->install();
	}
}