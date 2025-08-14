<?php
namespace Emp2407364\ContactForm\Model\ResourceModel;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Contact extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('Custom_table', null); // Replace with your table name and primary key
    }
}