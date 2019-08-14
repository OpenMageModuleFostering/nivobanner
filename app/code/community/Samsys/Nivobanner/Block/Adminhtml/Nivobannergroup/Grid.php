<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobannergroup_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('nivobannergroupGrid');
        $this->setDefaultSort('group_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('nivobanner/nivobannergroup')->getCollection();
        //$collection->getSelect()->columns(array('banner_effect' => 'if((animation_type=0),pre_banner_effects,banner_effects)'));
		$collection->getSelect()->columns();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('group_id', array(
            'header' => Mage::helper('nivobanner')->__('ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'group_id',
        ));

        $this->addColumn('group_name', array(
            'header' => Mage::helper('nivobanner')->__('Banner Group name'),
            'index' => 'group_name',
        ));
        
        $this->addColumn('group_code', array(
            'header' => Mage::helper('nivobanner')->__('Group code'),
            'width' => '100px',
            'index' => 'group_code',
        ));

        $this->addColumn('banner_width', array(
            'header' => Mage::helper('nivobanner')->__('Banner Width'),
            'width' => '100px',
            'align' => 'center',
            'index' => 'banner_width',
        ));

        $this->addColumn('banner_height', array(
            'header' => Mage::helper('nivobanner')->__('Banner Height'),
            'width' => '100px',
            'align' => 'center',
            'index' => 'banner_height',
        ));

        $this->addColumn('banner_effects', array(
            'header' => Mage::helper('nivobanner')->__('Banner Animation'),
            'width' => '100px',
            'align' => 'center',
            'index' => 'banner_effects',
         ));


        $this->addColumn('banner_ids', array(
            'header' => Mage::helper('nivobanner')->__('Banners Ids'),
            'width' => '50px',
            'index' => 'banner_ids',
        ));
        
       
        
        $this->addColumn('status', array(
            'header' => Mage::helper('nivobanner')->__('Status'),
            'align' => 'left',
            'width' => '80px',
            'index' => 'status',
            'type' => 'options',
            'options' => array(
                1 => 'Enabled',
                2 => 'Disabled',
            ),
        ));

        $this->addColumn('action',
                array(
                    'header' => Mage::helper('nivobanner')->__('Action'),
                    'width' => '50',
                    'type' => 'action',
                    'getter' => 'getId',
                    'actions' => array(
                        array(
                            'caption' => Mage::helper('nivobanner')->__('Edit'),
                            'url' => array('base' => '*/*/edit'),
                            'field' => 'id'
                        )
                    ),
                    'filter' => false,
                    'sortable' => false,
                    'index' => 'stores',
                    'is_system' => true,
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('group_id');
        $this->getMassactionBlock()->setFormFieldName('banner');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('nivobanner')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('nivobanner')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('nivobanner/status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('nivobanner')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('nivobanner')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}