<?php
namespace 
Nishu\HelloWorld\Controller\Message;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
 
class View extends Action
{
    protected $resultPageFactory;
 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
 