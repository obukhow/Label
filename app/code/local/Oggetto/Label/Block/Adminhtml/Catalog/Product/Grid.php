<?php

/**
 * extends default Magento Grid Block
 * for adding new mass-attribute to a grid
 * 
 *
 * @category   Oggetto
 * @package    Oggetto_Label
 * @subpackage AdminHTML
 * @since      Class available since module release 2.0
 * @author     roomine
 */
class Oggetto_Label_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    protected function _prepareCollection()
    {
        $store = $this->_getStore();
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('attribute_set_id')
            ->addAttributeToSelect('type_id')
            ->addAttributeToSelect('is_label')
            ->joinField('qty',
                'cataloginventory/stock_item',
                'qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left');

        if ($store->getId()) {
            $collection->setStoreId($store->getId());
            $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
            $collection->addStoreFilter($store);
            $collection->joinAttribute('name', 'catalog_product/name', 'entity_id', null, 'inner', $adminStore);
            $collection->joinAttribute('custom_name', 'catalog_product/name', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner', $store->getId());
            $collection->joinAttribute('price', 'catalog_product/price', 'entity_id', null, 'left', $store->getId());
            $collection->joinAttribute('is_label', 'attribute/Product_Attribute_Label', 'entity_id', null, 'left', $store->getId());
        }
        else {
            $collection->addAttributeToSelect('price');
            $collection->addAttributeToSelect('status');
            $collection->addAttributeToSelect('visibility');
        }
        $this->setCollection($collection);

        Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
        $this->getCollection()->addWebsiteNamesToResult();
        return $this;
    }
    
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('product');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('catalog')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('catalog/product_status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('catalog')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        $labels = Mage::getSingleton('attribute/Product_Attribute_Label')->toOptionArray();
        $this->getMassactionBlock()->addItem('label', array(
            'label' => Mage::helper('label')->__('Change label'),
            'url' => $this->getUrl('*/*/massLabel', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'label',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('label')->__('Label'),
                    'values' => $labels
                )
            )
        ));
        if (Mage::getSingleton('admin/session')->isAllowed('catalog/update_attributes')) {
            $this->getMassactionBlock()->addItem('attributes', array(
                'label' => Mage::helper('catalog')->__('Update Attributes'),
                'url' => $this->getUrl('*/catalog_product_action_attribute/edit', array('_current' => true))
            ));
        }

        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id',
                array(
                    'header' => Mage::helper('catalog')->__('ID'),
                    'width' => '50px',
                    'type' => 'number',
                    'index' => 'entity_id',
        ));
        $this->addColumn('name',
                array(
                    'header' => Mage::helper('catalog')->__('Name'),
                    'index' => 'name',
        ));

        $store = $this->_getStore();
        if ($store->getId()) {
            $this->addColumn('custom_name',
                    array(
                        'header' => Mage::helper('catalog')->__('Name in %s', $store->getName()),
                        'index' => 'custom_name',
            ));
        }

        $this->addColumn('type',
                array(
                    'header' => Mage::helper('catalog')->__('Type'),
                    'width' => '60px',
                    'index' => 'type_id',
                    'type' => 'options',
                    'options' => Mage::getSingleton('catalog/product_type')->getOptionArray(),
        ));

        $sets = Mage::getResourceModel('eav/entity_attribute_set_collection')
                        ->setEntityTypeFilter(Mage::getModel('catalog/product')->getResource()->getTypeId())
                        ->load()
                        ->toOptionHash();

        $this->addColumn('set_name',
                array(
                    'header' => Mage::helper('catalog')->__('Attrib. Set Name'),
                    'width' => '100px',
                    'index' => 'attribute_set_id',
                    'type' => 'options',
                    'options' => $sets,
        ));

        $this->addColumn('sku',
                array(
                    'header' => Mage::helper('catalog')->__('SKU'),
                    'width' => '80px',
                    'index' => 'sku',
        ));

        $store = $this->_getStore();
        $this->addColumn('price',
                array(
                    'header' => Mage::helper('catalog')->__('Price'),
                    'type' => 'price',
                    'currency_code' => $store->getBaseCurrency()->getCode(),
                    'index' => 'price',
        ));

        $this->addColumn('qty',
                array(
                    'header' => Mage::helper('catalog')->__('Qty'),
                    'width' => '100px',
                    'type' => 'number',
                    'index' => 'qty',
        ));

        $this->addColumn('visibility',
                array(
                    'header' => Mage::helper('catalog')->__('Visibility'),
                    'width' => '70px',
                    'index' => 'visibility',
                    'type' => 'options',
                    'options' => Mage::getModel('catalog/product_visibility')->getOptionArray(),
        ));

        $this->addColumn('status',
                array(
                    'header' => Mage::helper('catalog')->__('Status'),
                    'width' => '70px',
                    'index' => 'status',
                    'type' => 'options',
                    'options' => Mage::getSingleton('catalog/product_status')->getOptionArray(),
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('websites',
                    array(
                        'header' => Mage::helper('catalog')->__('Websites'),
                        'width' => '100px',
                        'sortable' => false,
                        'index' => 'websites',
                        'type' => 'options',
                        'options' => Mage::getModel('core/website')->getCollection()->toOptionHash(),
            ));
        }
        $this->addColumn('label',
                array(
                    'header' => Mage::helper('label')->__('Label'),
                    'width' => '100px',
                    'sortable' => true,
                    'index' => 'is_label',
                    'type' => 'options',
                    'options' => Mage::getSingleton('attribute/Product_Attribute_Label')->getAllOptions(),
        ));
        $this->addColumn('action',
                array(
                    'header' => Mage::helper('catalog')->__('Action'),
                    'width' => '50px',
                    'type' => 'action',
                    'getter' => 'getId',
                    'actions' => array(
                        array(
                            'caption' => Mage::helper('catalog')->__('Edit'),
                            'url' => array(
                                'base' => '*/*/edit',
                                'params' => array('store' => $this->getRequest()->getParam('store'))
                            ),
                            'field' => 'id'
                        )
                    ),
                    'filter' => false,
                    'sortable' => false,
                    'index' => 'stores',
        ));

        $this->addRssList('rss/catalog/notifystock', Mage::helper('catalog')->__('Notify Low Stock RSS'));

        return parent::_prepareColumns();
    }
     

}
