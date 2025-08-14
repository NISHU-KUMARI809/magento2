<?php
namespace Nishu\HelloWorld\Model\ResourceModel\Contact;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Nishu\HelloWorld\Model\Contact::class,
            \Nishu\HelloWorld\Model\ResourceModel\Contact::class
        );
    }
}
 