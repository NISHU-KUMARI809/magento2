<?php
namespace 
Nishu\HelloWorld\Controller\Form1Plugin;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
 
class Index extends Action
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }
 
    public function execute()
    {
        return $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
    }
}
 
 