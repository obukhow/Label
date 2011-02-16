<?php

class Oggetto_Label_IndexController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $block = $this->getLayout()->createBlock('adminhtml/system_account_edit');
        $this->getLayout()->getBlock('content')->append($block);
    }

}