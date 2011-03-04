<?
class Oggetto_Label_Model_Product_Attribute_Display extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
               array(
                    'value' => '1',
                    'label' => Mage::helper('label')->__('Product & Category'),
                ),
                array(
                    'value' => '2',
                    'label' => Mage::helper('label')->__('Product'),
                ),
                 array(
                    'value' => '3',
                    'label' => Mage::helper('label')->__('Category'),
                )
            );
        }
        return $this->_options;
    }
     public function toOptionArray()
    {
        return array(
            array(
                'value' => 1,
                'label' => Mage::helper('label')->__('Product & Category')
                ),
            array(
                'value' => 2,
                'label' => Mage::helper('label')->__('Product')
                ),
            array(
                'value' => 3,
                'label' => Mage::helper('label')->__('Category')
                ),
        );
    }
}