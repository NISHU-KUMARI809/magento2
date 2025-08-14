<?php
namespace Emp2407364\ContactForm\Model\ResourceModel\Contact;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Emp2407364\ContactForm\Model\Contact::class,
            \Emp2407364\ContactForm\Model\ResourceModel\Contact::class
        );
    }
}