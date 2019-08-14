<?php

class Samsys_Nivobanner_Model_Mysql4_Nivobanner_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('nivobanner/nivobanner');
    }

}