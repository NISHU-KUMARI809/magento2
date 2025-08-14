<?php
namespace Nishu\HelloWorld\Model\ResourceModel;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Contact extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('nishu_contact_form', 'id'); // DB table name and primary key
    }
}