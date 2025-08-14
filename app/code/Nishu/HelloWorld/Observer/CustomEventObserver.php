<?php
namespace 
Nishu\HelloWorld\Observer;
 
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
 
class CustomEventObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $message = $observer->getData('custom_message');
 
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom_event.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info("📣 Custom Event Triggered: " . $message);
    }
}
 