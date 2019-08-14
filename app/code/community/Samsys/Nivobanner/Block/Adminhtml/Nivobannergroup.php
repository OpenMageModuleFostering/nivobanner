<?php
/**
 * sam-sys
 * @category   samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 Samsys Systems. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobannergroup extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_nivobannergroup';
        $this->_blockGroup = 'nivobanner';
        $this->_headerText = Mage::helper('nivobanner')->__('Banner Group Manager');
        $this->_addButtonLabel = Mage::helper('nivobanner')->__('Add Banner Group');
        parent::__construct();
    }

}