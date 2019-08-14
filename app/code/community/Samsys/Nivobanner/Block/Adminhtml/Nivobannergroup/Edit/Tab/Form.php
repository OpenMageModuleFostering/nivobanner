<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobannergroup_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('nivobannergroup_form', array('legend' => Mage::helper('nivobanner')->__('Item information')));
        $animations = Mage::getSingleton('nivobanner/status')->getAnimationArray();
      

        $fieldset->addField('group_name', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Banner Group Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'group_name',
        ));

        if (Mage::registry('nivobannergroup_data')->getId() == null) {
            $fieldset->addField('group_code', 'text', array(
                'label' => Mage::helper('nivobanner')->__('Banner Group Code'),
                'class' => 'required-entry',
                'name' => 'group_code',
                'required' => true,
            ));
        }

        $fieldset->addField('banner_width', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Banner Width [in px]'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'banner_width',
        ));

        $fieldset->addField('banner_height', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Banner Height [in px]'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'banner_height',
        ));
		
		 $fieldset->addField('banner_effects', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Banner Effect'),
			'class' => 'required-entry',
			'required' => true,
            'name' => 'banner_effects',
			'values' => $animations
        ));
		 $fieldset->addField('animation_speed', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Animation Speed'),
			'class' => 'required-entry',
			'required' => true,
            'name' => 'animation_speed',
			'after_element_html' => '<p class="note"><span>In Milliseconds [eg: 1 Second = 1000 Millisecond] </span></p>',
        ));
		
		$fieldset->addField('pause_time', 'text', array(
            'label' => Mage::helper('nivobanner')->__('Pause Time'),
			'class' => 'required-entry',
			'required' => true,
            'name' => 'pause_time',
			'after_element_html' => '<p class="note"><span>In Milliseconds [eg: 1 Second = 1000 Millisecond] </span></p>',
        ));
		
		$fieldset->addField('image_nav', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Image Navigation'),
            'name' => 'image_nav',
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
		
		$fieldset->addField('image_pagi', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Image Pagination'),
            'name' => 'image_pagi',
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
		
		$fieldset->addField('hover_pause', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Pause on Mouseover'),
            'name' => 'hover_pause',
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

		$fieldset->addField('autoplay', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Autoplay Slides'),          
            'name' => 'autoplay',
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
		
		 $fieldset->addField('theme', 'select', array(
            'label' => Mage::helper('nivobanner')->__('Theme'),  
            'name' => 'theme',
			'values' => array(
				array(
                    'value' => 'default',
                    'label' => Mage::helper('nivobanner')->__('Default'),
                ),
                array(
                    'value' => 'dark',
                    'label' => Mage::helper('nivobanner')->__('Dark'),
                ),
				array(
                    'value' => 'light',
                    'label' => Mage::helper('nivobanner')->__('Light'),
                ),
				array(
                    'value' => 'bar',
                    'label' => Mage::helper('nivobanner')->__('Bar'),
                ),
            ),
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

//        $fieldset->addField('banner_ids', 'multiselect', array(
//            'label' => Mage::helper('nivobanner')->__('Banner Images'),
//            'class' => 'required-entry',
//            'required' => true,
//            'name' => 'banner_ids[]',
//            'values' => $bannerData,
//        ));


        if (Mage::getSingleton('adminhtml/session')->getBannergroupData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBannergroupData());
            Mage::getSingleton('adminhtml/session')->setBannergroupData(null);
        } elseif (Mage::registry('nivobannergroup_data')) {
            $form->setValues(Mage::registry('nivobannergroup_data')->getData());
        }
        return parent::_prepareForm();
    }

}