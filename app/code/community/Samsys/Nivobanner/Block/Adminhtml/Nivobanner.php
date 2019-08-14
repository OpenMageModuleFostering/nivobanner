<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobanner extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
	/*path to our banner controller =  adminhtml bannercontroller*/
        $this->_controller = 'adminhtml_nivobanner';
        $this->_blockGroup = 'nivobanner';
        $this->_headerText = Mage::helper('nivobanner')->__('Banner Manager');
        $this->_addButtonLabel = Mage::helper('nivobanner')->__('Add Banner Item');
        parent::__construct();
		
    }
}