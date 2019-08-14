<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Model_Mysql4_Nivobannergroup_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('nivobanner/nivobannergroup');
    }

    public function getDuplicateGroupCode($groupCode) {
        $this->setConnection($this->getResource()->getReadConnection());
        $table = $this->getTable('nivobanner/nivobannergroup');
        $select = $this->getSelect();
        $select->from(array('main_table' => $table), 'group_id')
                ->where('group_code = ?', $groupCode);
        return $this;
    }
}