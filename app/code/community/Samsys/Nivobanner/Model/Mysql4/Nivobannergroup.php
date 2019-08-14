<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Model_Mysql4_Nivobannergroup extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct() {
        $this->_init('nivobanner/nivobannergroup', 'group_id');
    }

    public function _beforeSave(Mage_Core_Model_Abstract $object) {
        $isDataValid = true;
        $id = $object->getId();
        $groupCode = $object->getGroupCode();
        $groupCollection = Mage::getModel('nivobanner/nivobannergroup')->getCollection();
        if ($id == '' || $id == 0) {
            if ($groupCode == '') {
                throw new Exception('Banner Group code can\'t be blank !!');
            } else {
                $groupInfo = $groupCollection->getDuplicateGroupCode($groupCode);
                if ($groupInfo->count() > 0) {
                    $isDataValid = false;
                }
                if ($isDataValid === false) {
                    throw new Exception("Banner Group Code already exists !!");
                }
            }
        }
    }

}