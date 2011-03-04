<?

class Oggetto_Label_Model_Product_Attribute_Position extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'value' => 'topleft',
                    'label' => Mage::helper('label')->__('Top left'),
                ),
                array(
                    'value' => 'topright',
                    'label' => Mage::helper('label')->__('Top right'),
                ),
                array(
                    'value' => 'center',
                    'label' => Mage::helper('label')->__('Center'),
                ),
                array(
                    'value' => 'bottomleft',
                    'label' => Mage::helper('label')->__('Bottom left'),
                ),
                array(
                    'value' => 'bottomright',
                    'label' => Mage::helper('label')->__('Bottom right'),
                )
            );
        }
        return $this->_options;
    }

    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'topleft',
                'label' => Mage::helper('label')->__('Top left'),
            ),
            array(
                'value' => 'topright',
                'label' => Mage::helper('label')->__('Top right'),
            ),
            array(
                'value' => 'center',
                'label' => Mage::helper('label')->__('Center'),
            ),
            array(
                'value' => 'bottomleft',
                'label' => Mage::helper('label')->__('Bottom left'),
            ),
            array(
                'value' => 'bottomright',
                'label' => Mage::helper('label')->__('Bottom right'),
            )
        );
    }

}