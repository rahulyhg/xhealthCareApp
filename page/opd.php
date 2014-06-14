<?php
class page_paid extends Page {
    function init(){
        parent::init();


        $Bill=$this->add('Grid');
        $Bill->setModel('OPD');
    }
}
