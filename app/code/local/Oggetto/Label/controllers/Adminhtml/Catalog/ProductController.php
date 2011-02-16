<?php
require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';
class Oggetto_Label_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Catalog_ProductController
{
    
    public function massLabelAction()
    {
        $productIds = (array)$this->getRequest()->getParam('product');
        $storeId    = (int)$this->getRequest()->getParam('store', 0);
        $label     = (int)$this->getRequest()->getParam('label');
        try {
            Mage::getSingleton('catalog/product_action')
                ->updateAttributes($productIds, array('is_label' => $label), $storeId);

            $this->_getSession()->addSuccess(
                $this->__('Total of %d label(s) have been updated.', count($productIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
        catch (Exception $e) {
            $this->_getSession()->addException($e, $this->__('An error occurred while updating the product(s) lable.'));
        }

        $this->_redirect('*/*/', array('store'=> $storeId));
    }

    
}
