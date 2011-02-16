<?php

class Oggetto_Label_Helper_Data extends Mage_Core_Helper_Abstract
{

    protected $_position;
    protected $_product;
    protected $_size;
    protected $_image;
    protected $_page;
    protected $_labeltype;
    protected $_display;
    protected $_label;
    protected $_show = 0;

    /* get label if it is
     * 
     * $_product product we working with
     * $_page category/product
     * $_size size of the image
     */

    public function getLabel($product, $page, $size)
    {
        $this->_labeltype = $product->getIsLabel();
        $this->_product = $product;
        $this->_page = $page;
        $this->_size = $size;
        switch ($this->_labeltype) {
            case 0:
                return;
                break;
            case 5:
                $this->getCustomLabel();
                break;
            default :
                $this->getDefaultLabel();
                break;
        }
        $this->toShow();
        $this->returnLabel();
        return $this->_label;
    }

    public function getCustomLabel()
    {
        $this->_display = $this->_product->getLabelDisplay();
        $this->setPosition($this->_product->getLabelPosition());
        $this->getImage($this->_product->getLabelImage());
    }

    public function getDefaultLabel()
    {
        $this->_display = Mage::getStoreConfig('label/label_group' . $this->_labeltype . '/label_display' . $this->_labeltype);
        $this->setPosition(Mage::getStoreConfig('label/label_group' . $this->_labeltype . '/label_position' . $this->_labeltype));
        $this->getImage(Mage::getStoreConfig('label/label_group' . $this->_labeltype . '/label_image' . $this->_labeltype));
    }

    public function setPosition($position)
    {
        switch ($position) {
            case 'topleft':
                $this->_position = "top left";
                break;
            case 'topright':
                $this->_position = "top right";
                break;
            case 'center':
                $this->_position = "center center";
                break;
            case 'bottomleft':
                $this->_position = "bottom left";
                break;
            case 'bottomright':
                $this->_position = "bottom right";
                break;
        }
    }

    public function getImage($image)
    {
        if ($this->_page == 'category')
            $this->_image = Mage::helper('catalog/image')->init($this->_product, 'thumbnail', $image)->constrainOnly(1)->resize(60);
        else
            $this->_image = Mage::helper('catalog/image')->init($this->_product, 'thumbnail', $image);
    }

    public function returnLabel()
    {
        if ($this->_show)
            $this->_label = '<div class="product-img-label" style="position:absolute; height:' .
                    $this->_size . 'px; width: ' .
                    $this->_size . 'px; top:12px; left:10px; z-index: 70; pointer-events: none;background: url(\'' .
                    $this->_image . '\') ' . $this->_position . ' no-repeat"></div>';
        else
            $this->_label = null;
    }

    public function toShow()
    {
        if ($this->_display == 1 || $this->_display == 3 && $this->_page == 'category')
            $this->_show = 1;
        elseif ($this->_display == 1 || $this->_display == 2 && $this->_page == 'product')
            $this->_show = 1;
        else
            $this->_show = 0;
    }

}
