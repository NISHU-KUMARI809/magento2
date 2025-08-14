<?php
namespace 
Nishu\HelloWorld\Controller\Index1Event;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Event\ManagerInterface;
 
class Index extends Action
{
    protected $_eventManager;
 
    public function __construct(
        Context $context,
        ManagerInterface $eventManager
    ) {
        $this->_eventManager = $eventManager;
        parent::__construct($context);
    }
 
    public function execute()
    {
        // Dispatch custom event
        $this->_eventManager->dispatch('nishu_custom_event', [
            'custom_message' => 'This is my custom event!'
        ]);
 
        // Load Luma page with layout
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
 
 