<?php
/**
 * Sam-Sys
 * @category   Samsys
 * @package    Samsys_Nivobanner
 * @copyright  Copyright (c) 2013-2014 sam-sys. (http://www.sam-sys.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
class Samsys_Nivobanner_Block_Adminhtml_Nivobanner_Grid extends Samsys_Nivobanner_Block_Adminhtml_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('nivobannerGrid');
        $this->setDefaultSort('banner_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('nivobanner/nivobanner')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn('nivobanner_id', array(
            'header' => Mage::helper('nivobanner')->__('ID'),
            'align' => 'center',
            'width' => '30px',
            'index' => 'banner_id',
        ));

        $this->addColumn('filename', array(
            'header' => Mage::helper('nivobanner')->__('Image'),
            'align' => 'center',
            'index' => 'filename',
			/*for rendering image we are creating widget in name nivobanner*/
            'type' => 'nivobanner',
            'escape' => true,
            'sortable' => false,
            'width' => '150px',
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('nivobanner')->__('Title'),
            'index' => 'title',
        ));
		
		$this->addColumn('link', array(
            'header' => Mage::helper('nivobanner')->__('Link'),
            'index' => 'link',
			'width' => '150px',
        ));
		
		 $this->addColumn('show_title', array(
            'header' => Mage::helper('nivobanner')->__('Show Title'),
            'align' => 'center',
            'width' => '80px',
            'index' => 'show_title',
            'type' => 'options',
            'options' => array(
                1 => 'Yes',
                0 => 'No',
            ),
        ));
        $this->addColumn('show_content', array(
            'header' => Mage::helper('nivobanner')->__('Show Content'),
            'align' => 'center',
            'width' => '80px',
            'index' => 'show_content',
            'type' => 'options',
            'options' => array(
                1 => 'Yes',
                0 => 'No',
            ),
        ));

       

        $this->addColumn('sort_order', array(
            'header' => Mage::helper('nivobanner')->__('Sort Order'),
            'width' => '80px',
            'index' => 'sort_order',
            'align' => 'center',
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
                    'width' => '80',
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
	
		/*to get multiple delete and change status actions*/
	 protected function _prepareMassaction() {
        $this->setMassactionIdField('banner_id');
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