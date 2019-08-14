<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobannergroup_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('nivobannergroup_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('nivobanner')->__('Banner Group Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section', array(
            'label' => Mage::helper('nivobanner')->__('Banner Group'),
            'alt' => Mage::helper('nivobanner')->__('Banner Group'),
            'content' => $this->getLayout()->createBlock('nivobanner/adminhtml_nivobannergroup_edit_tab_form')->toHtml(),
        ));

        $this->addTab('grid_section', array(
            'label' => Mage::helper('nivobanner')->__('Banners'),
            'alt' => Mage::helper('nivobanner')->__('Banners'),
            'content' => $this->getLayout()->createBlock('nivobanner/adminhtml_nivobannergroup_edit_tab_gridbanner')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}