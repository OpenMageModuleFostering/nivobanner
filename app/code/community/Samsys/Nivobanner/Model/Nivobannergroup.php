<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Model_Nivobannergroup extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('nivobanner/nivobannergroup');
    }

    public function getDataByGroupCode($groupCode) { 
	  
        $groupData = array();
        $bannerData = array();
        $result = array('group_data'=>$groupData,'banner_data'=>$bannerData);
        $collection = Mage::getResourceModel('nivobanner/nivobannergroup_collection');
        $collection->getSelect()->where('group_code = ?', $groupCode)->where('status = 1');
        foreach ($collection as $record) {
            $bannerIds = $record->getBannerIds();
            $bannerModel = Mage::getModel('nivobanner/nivobanner');
            $bannerData = $bannerModel->getDataByBannerIds($bannerIds);
            $result = array('group_data' => $record, 'banner_data' => $bannerData);
        }
        return $result;
    }

}