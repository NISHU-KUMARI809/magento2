<?php
namespace Emp2407364\ContactForm\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Contact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Emp2407364\ContactForm\Model\ResourceModel\Contact::class);
    }
}