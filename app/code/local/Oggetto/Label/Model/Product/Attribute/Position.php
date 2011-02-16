<?

class Oggetto_Label_Model_Product_Attribute_Position extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                array(
                    'value' => 'topleft',
                    'label' => 'Top left',
                ),
                array(
                    'value' => 'topright',
                    'label' => 'Top right',
                ),
                array(
                    'value' => 'center',
                    'label' => 'Center',
                ),
                array(
                    'value' => 'bottomleft',
                    'label' => 'Bottom left',
                ),
                array(
                    'value' => 'bottomright',
                    'label' => 'Bottom right',
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
                'label' => 'Top left'
            ),
            array(
                'value' => 'topright',
                'label' => 'Top right'
            ),
            array(
                'value' => 'center',
                'label' => 'Center',
            ),
            array(
                'value' => 'bottomleft',
                'label' => 'Bottom left'
            ),
            array(
                'value' => 'bottomright',
                'label' => 'Bottom right'
            )
        );
    }

}