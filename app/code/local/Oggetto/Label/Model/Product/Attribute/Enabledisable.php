<?
class Oggetto_Label_Model_Product_Attribute_Enabledisable extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
               array(
                    'value' => '0',
                    'label' => Mage::helper('label')->__('No'),
                ),
                array(
                    'value' => '1',
                    'label' => Mage::helper('label')->__('Yes'),
                )
            );
        }
        return $this->_options;
    }
}