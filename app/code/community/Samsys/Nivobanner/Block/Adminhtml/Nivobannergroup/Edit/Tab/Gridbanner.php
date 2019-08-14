<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobannergroup_Edit_Tab_Gridbanner extends Mage_Adminhtml_Block_Widget_Container {

    /**
     * Set template
     */
    public function __construct() {
        parent::__construct();
        $this->setTemplate('nivobanner/banner.phtml');
    }

    public function getTabsHtml() {
        return $this->getChildHtml('tabs');
    }

    /**
     * Prepare button and grid
     *
     */
    protected function _prepareLayout() {
        $this->setChild('tabs', $this->getLayout()->createBlock('nivobanner/adminhtml_nivobannergroup_edit_tab_banner', 'nivobannergroup.grid.banner'));
        return parent::_prepareLayout();
    }

    public function getBannergroupData() {
        return Mage::registry('nivobannergroup_data');
    }

    public function getBannersJson() {
        $banners = explode(',', $this->getBannergroupData()->getBannerIds());
        if (!empty($banners) && isset($banners[0]) && $banners[0] != '') {
            $data = array();
            foreach ($banners as $element) {
                $data[$element] = $element;
            }
            return Zend_Json::encode($data);
        }
        return '{}';
    }

}
