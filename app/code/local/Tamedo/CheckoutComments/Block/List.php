<?php

class Tamedo_CheckoutComments_Block_List extends Mage_Core_Block_Template {

    public function getComments(){
        $comments = $this->getData('comments');
        if (is_null ($comments)){
            $session = Mage::getSingleton('customer/session');
            $comments = Mage::getResourceSingleton('checkoutcomments/comment_collection')
            ->addCustomerFilter($session->getCustomer());
            $this->setData('comments', $comments);
        }
        return $comments;

    }
}