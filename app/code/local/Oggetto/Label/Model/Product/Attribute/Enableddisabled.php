<?
class Oggetto_Label_Model_Product_Attribute_Enableddisabled extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
               array(
                    'value' => '0',
                    'label' => Mage::helper('label')->__('disabled'),
                ),
                array(
                    'value' => '1',
                    'label' => Mage::helper('label')->__('enabled'),
                )
            );
        }
        return $this->_options;
    }
}