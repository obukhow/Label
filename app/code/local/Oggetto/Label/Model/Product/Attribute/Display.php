<?
class Oggetto_Label_Model_Product_Attribute_Display extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
               array(
                    'value' => '1',
                    'label' => 'Product & Category',
                ),
                array(
                    'value' => '2',
                    'label' => 'Product',
                ),
                 array(
                    'value' => '3',
                    'label' => 'Category',
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
                'label' => 'Product & Category'
                ),
            array(
                'value' => 2,
                'label' => 'Product'
                ),
            array(
                'value' => 3,
                'label' => 'Category'
                ),
        );
    }
}