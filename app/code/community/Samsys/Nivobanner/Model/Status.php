<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Model_Status extends Varien_Object {
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;

    static public function getOptionArray() {
        return array(
            self::STATUS_ENABLED => Mage::helper('nivobanner')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('nivobanner')->__('Disabled')
        );
    }

    static public function getAnimationArray() {
        $animations = array();
        $animations = array(
            array(
                'value' => 'random',
                'label' => Mage::helper('nivobanner')->__('Random'),
            ),
            array(
                'value' => 'sliceDown',
                'label' => Mage::helper('nivobanner')->__('Slice Down'),
            ),

            array(
                'value' => 'sliceDownLeft',
                'label' => Mage::helper('nivobanner')->__('slice Down Left'),
            ),
            array(
                'value' => 'sliceUp',
                'label' => Mage::helper('nivobanner')->__('Slice Up'),
            ),
            array(
                'value' => 'sliceUpLeft',
                'label' => Mage::helper('nivobanner')->__('Slice Up Left'),
            ),
            array(
                'value' => 'sliceUpDown',
                'label' => Mage::helper('nivobanner')->__('Slice Up Down'),
            ),
            array(
                'value' => 'sliceUpDownLeft',
                'label' => Mage::helper('nivobanner')->__('Slice UpDown Left'),
            ),         
            array(
                'value' => 'fold',
                'label' => Mage::helper('nivobanner')->__('Fold'),
            ),
   
            array(
                'value' => 'fade',
                'label' => Mage::helper('nivobanner')->__('fade'),
            ),
             array(
                'value' => 'slideInRight',
                'label' => Mage::helper('nivobanner')->__('SlideIn Right'),
            ),            
            array(
                'value' => 'slideInLeft',
                'label' => Mage::helper('nivobanner')->__('SlideIn Left'),
            ),
			array(
                'value' => 'boxRandom',
                'label' => Mage::helper('nivobanner')->__('Box Random'),
            ), 
			array(
                'value' => 'boxRain',
                'label' => Mage::helper('nivobanner')->__('Box Rain'),
            ), 
			array(
                'value' => 'boxRainReverse',
                'label' => Mage::helper('nivobanner')->__('BoxRain Reverse'),
            ), 
			array(
                'value' => 'boxRainGrow',
                'label' => Mage::helper('nivobanner')->__('BoxRain Grow'),
            ), 
			array(
                'value' => 'boxRainGrowReverse',
                'label' => Mage::helper('nivobanner')->__('BoxRain GrowReverse'),
            ), 
        );
        array_unshift($animations, array('label' => '--Select--', 'value' => ''));
        return $animations;
    }

   

}