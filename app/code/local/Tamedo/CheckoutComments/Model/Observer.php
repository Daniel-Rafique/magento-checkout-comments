<?php
/**
 * Created by Tamedo.
 * User: Daniel Rafique
 * Date: 18/11/2013
 * Time: 13:30
 * Copyright all rights reserved to author of this content.
 */

class Tamedo_CheckoutComments_Model_Observer {

    public function prepareCheckoutComment($observer){

        $message = $observer->getControllerAction()
                            ->getRequest()
                            ->getPost('checkoutcomments');
        Mage::getSingleton('core/session')->setCheckoutComment($message);
    }

    public function saveCheckoutComment($observer){

        $order = $observer->getOrder();
        $message = Mage::getSingleton('core/session')->getCheckoutComment(true);

        if (!$order || empty ($message)) {
            return;
        }
        $commentModel = Mage::getModel('checkoutcomments/comment');
        $commentModel->setOrderId($order->getId())
                     ->setComment($message)
                     ->save();
    }

    public function displayCheckoutComment($observer){

        $block = $observer->getBlock();

        if ($block && $block->getParentBlock());
            if ('gift_options' == $block->getNameInLayout()
                && 'order_tab_info' == $block->getParentBlock()->getNameInLayout())
            {

                $order = $block->getParentBlock()->getOrder();
                $commentModel = Mage::getModel('checkoutcomments/comment')
                    ->load($order->getId(), 'order_id');

                if ($commentModel->getId()){

                    $html = $observer->getTransport()->getHtml();
                    $commentBlock = $block->getLayout()->createBlock('adminhtml/template')
                                           ->setTemplate('tamedo/checkoutcomments/comment.phtml')
                                           ->setCommentModel($commentModel);
                    $observer->setTransport()->setHtml($html . $commentBlock->toHtml());

                }

            }

     }


}