<?php
/**
 * Created by Tamedo.
 * User: Daniel Rafique
 * Date: 18/11/2013
 * Time: 11:12
 * Copyright all rights reserved to author of this content.
 */

class Tamedo_CheckoutComments_Model_Resource_Comment extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {

        $this->_init('checkoutcomments/comments_table', 'comment_id');
    }
}