<?

class Oggetto_Label_Model_Product_Attribute_Label extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    public function toOptionArray()
    {
        $labels = array();
        $labels[] = array('value' => '0', 'label' => Mage::helper('label')->__('No'));
        

        if (Mage::getStoreConfig('label/label_group1/label_name1'))
            $labels[] = array('value' => '1', 'label' => Mage::getStoreConfig('label/label_group1/label_name1'));

        if (Mage::getStoreConfig('label/label_group2/label_name2'))
            $labels[] = array('value' => '2', 'label' => Mage::getStoreConfig('label/label_group2/label_name2'));

        if (Mage::getStoreConfig('label/label_group3/label_name3'))
            $labels[] = array('value' => '3', 'label' => Mage::getStoreConfig('label/label_group3/label_name3'));

        if (Mage::getStoreConfig('label/label_group4/label_name4'))
            $labels[] = array('value' => '4', 'label' => Mage::getStoreConfig('label/label_group4/label_name4'));
       $labels[] = array('value' => '5', 'label' => Mage::helper('label')->__('Custom'));
        return $labels;
    }
     public function getOptionArray()
    {
        $labels = array();
        $labels['0'] = Mage::helper('label')->__('No');


        if (Mage::getStoreConfig('label/label_group1/label_name1'))
            $labels['1'] = Mage::getStoreConfig('label/label_group1/label_name1');

        if (Mage::getStoreConfig('label/label_group2/label_name2'))
            $labels['2'] = Mage::getStoreConfig('label/label_group2/label_name2');

        if (Mage::getStoreConfig('label/label_group3/label_name3'))
            $labels['3'] = Mage::getStoreConfig('label/label_group3/label_name3');

        if (Mage::getStoreConfig('label/label_group4/label_name4'))
            $labels['4'] = Mage::getStoreConfig('label/label_group4/label_name4');

       $labels['5'] = Mage::helper('label')->__('Custom');
        return $labels;
    }
     /**
     * Retrieve option array with empty value
     *
     * @return array
     */
   public function getAllOption()
    {
        $options = self::getOptionArray();
        array_unshift($options, array('value'=>'', 'label'=>''));
        return $options;
    }
    public function getAllOptions()
    {
//        $res = array(
//            array(
//                'value' => '',
//                'label' => Mage::helper('catalog')->__('-- Please Select --')
//            )
//        );
        foreach (self::getOptionArray() as $index => $value) {
            $res[$index] = $value ;
        }
        return $res;
    }


}