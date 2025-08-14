<?php
namespace Nishu\HelloWorld\Controller\Adminhtml\Grid;
 
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends Action
{
    protected $resultPageFactory;
 
    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
 
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Nishu_HelloWorld::grid');
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Form Grid'));
        return $resultPage;
    }
 
    protected function _isAllowed()
    {
        return true;
    }
}
 