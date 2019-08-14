<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobannergroup_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'nivobanner';
        $this->_controller = 'adminhtml_nivobannergroup';

        $this->_updateButton('save', 'label', Mage::helper('nivobanner')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('nivobanner')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
                ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('banner_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'banner_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'banner_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
      
        ";
    }

    public function getHeaderText() {
        if (Mage::registry('nivobannergroup_data') && Mage::registry('nivobannergroup_data')->getId()) {
            return Mage::helper('nivobanner')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('nivobannergroup_data')->getGroupName()));
        } else {
            return Mage::helper('nivobanner')->__('Add Item');
        }
    }

}