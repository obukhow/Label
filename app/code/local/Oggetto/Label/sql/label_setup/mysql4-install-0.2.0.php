<?php

$installer = $this;

/* @var $installer Mage_Customer_Model_Entity_Setup */
$installer->startSetup();
$installer->removeAttribute('catalog_product', 'is_label');
$installer->removeAttribute('catalog_product', 'label_position');
$installer->removeAttribute('catalog_product', 'label_display');
$installer->removeAttribute('catalog_product', 'label_image');

$installer->addAttribute('catalog_product', 'is_label', array(
    'group' => 'General',
    'type' => 'text',
    'input' => 'select',
    'label' => Mage::helper('label')->__('Label'),
    'global' => 1,
    'visible' => 1,
    'required' => 1,
    'user_defined' => 1,
    'default_value' => 0,
    'visible_on_front' => 1,
    'source' => 'attribute/Product_Attribute_Label',
));
$installer->addAttribute('catalog_product', 'label_position', array(
    'group' => Mage::helper('label')->__('Custom Label'),
    'type' => 'text',
    'input' => 'select',
    'label' => Mage::helper('label')->__('Position'),
    'global' => 1,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'default' => 0,
    'visible_on_front' => 1,
    'source' => 'attribute/Product_Attribute_Position',
));
$installer->addAttribute('catalog_product', 'label_display', array(
    'group' => Mage::helper('label')->__('Custom Label'),
    'type' => 'text',
    'input' => 'select',
    'label' => Mage::helper('label')->__('Display for'),
    'global' => 1,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'default' => 0,
    'visible_on_front' => 1,
    'source' => 'attribute/Product_Attribute_Display',
));
$installer->addAttribute('catalog_product', 'label_image', array(
    'group' => Mage::helper('label')->__('Custom Label'),
    'type' => 'varchar',
    'input' => 'image',
    'label' => Mage::helper('label')->__('Image'),
    'global' => 1,
    'visible' => 1,
    'required' => 0,
    'user_defined' => 1,
    'default' => 0,
    'visible_on_front' => 1,
    'backend' => 'attribute/Product_Attribute_Uploadimage',
));

$installer->endSetup();