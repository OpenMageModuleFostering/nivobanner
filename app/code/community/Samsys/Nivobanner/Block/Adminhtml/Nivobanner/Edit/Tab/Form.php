<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobanner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('nivobanner_form', array('legend' => Mage::helper('nivobanner')->__('Item information')));
        $version = substr(Mage::getVersion(), 0, 3);
        //$config = (($version == '1.4' || $version == '1.5') ? "'config' => Mage::getSingleton('banner/wysiwyg_config')->getConfig()" : "'class'=>''");

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'title',
        ));

        $fieldset->addField('link', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Link'),
            'name' => 'link',
        ));

        $fieldset->addField('banner_type', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Link Target'),
            'name' => 'link_target',
            'values' => array(
                array(
                    'value' => 0,
                    'label' => Mage::helper('nivobanner')->__('Self'),
                ),
                array(
                    'value' => 1,
                    'label' => Mage::helper('nivobanner')->__('New Window'),
                ),
            ),
        ));

        $fieldset->addField('filename', 'image', array(
            'label' => Mage::helper('nivobanner')->__('Image'),
			 'class' => 'required-entry',
            'required' => true,
            'name' => 'filename',
        ));

        if (in_array($version, array('1.4','1.5','1.6','1.7'))) {
            $fieldset->addField('banner_content', 'editor', array(
                'name' => 'banner_content',
                'label' => Mage::helper('nivobanner')->__('Content'),
                'title' => Mage::helper('nivobanner')->__('Content'),
                'style' => 'width:600px; height:250px;',
                'config' => Mage::getSingleton('nivobanner/wysiwyg_config')->getConfig(),
                'wysiwyg' => true,
                'required' => false,
            ));
        } else {
            $fieldset->addField('banner_content', 'editor', array(
                'name' => 'banner_content',
                'label' => Mage::helper('cms')->__('Content'),
                'title' => Mage::helper('cms')->__('Content'),
                'style' => 'width:600px; height:250px;',                
                'wysiwyg' => false,
                'required' => false,
            ));
        }
		
		$fieldset->addField('show_title', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Display Title'),
            'class' => 'required-entry',
            'name' => 'show_title',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('nivobanner')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('nivobanner')->__('No'),
                ),
            ),
        ));



        $fieldset->addField('show_content', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Display Content'),
            'class' => 'required-entry',
            'name' => 'show_content',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('nivobanner')->__('Yes'),
                ),
                array(
                    'value' => 0,
                    'label' => Mage::helper('nivobanner')->__('No'),
                ),
            ),
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Sort Order'),
            'name' => 'sort_order',
        ));

        $fieldset->addField('status', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Status'),
            'class' => 'required-entry',
            'name' => 'status',
            'values' => array(
                array(
                    'value' => 1,
                    'label' => Mage::helper('nivobanner')->__('Enabled'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('nivobanner')->__('Disabled'),
                ),
            ),
        ));

        if (Mage::getSingleton('adminhtml/session')->getBannerData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBannerData());
            Mage::getSingleton('adminhtml/session')->setBannerData(null);
        } elseif (Mage::registry('nivobanner_data')) {
            $form->setValues(Mage::registry('nivobanner_data')->getData());
        }
        return parent::_prepareForm();
    }

}