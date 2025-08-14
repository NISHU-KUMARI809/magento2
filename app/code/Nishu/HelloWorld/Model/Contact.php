<?php
namespace Nishu\HelloWorld\Model;
 
use Magento\Framework\Model\AbstractModel;
 
class Contact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Nishu\HelloWorld\Model\ResourceModel\Contact::class);
    }
}