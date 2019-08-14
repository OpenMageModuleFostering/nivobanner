<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Model_Nivobanner extends Mage_Core_Model_Abstract {

    public function _construct() {
        parent::_construct();
        $this->_init('nivobanner/nivobanner');
    }

    public function getAllAvailBannerIds(){
        $collection = Mage::getResourceModel('nivobanner/nivobanner_collection')
                        ->getAllIds();
        return $collection;
    }

    public function getAllBanners() {
        $collection = Mage::getResourceModel('nivobanner/nivobanner_collection');
        $collection->getSelect()->where('status = ?', 1);
        $data = array();
        foreach ($collection as $record) {
            $data[$record->getId()] = array('value' => $record->getId(), 'label' => $record->getfilename());
        }
        return $data;
    }

    public function getDataByBannerIds($bannerIds) {
        $data = array();
        if ($bannerIds != '') {
            $collection = Mage::getResourceModel('nivobanner/nivobanner_collection');
            $collection->getSelect()->where('banner_id IN (' . $bannerIds . ')')->order('sort_order');
            foreach ($collection as $record) {
                $status = $record->getStatus();
                if ($status == 1) {
                    $data[] = $record;
                }
            }
        }
        return $data;
    }

}