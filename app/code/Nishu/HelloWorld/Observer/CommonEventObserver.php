<?php
namespace 
Nishu\HelloWorld\Observer;
 
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
 
class CommonEventObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $eventName = $observer->getEvent()->getName(); // get event name
        $logFile = BP . '/var/log/events.log';
 
        switch ($eventName) {
            case 'customer_login':
                file_put_contents($logFile, "✅ Customer logged in\n", FILE_APPEND);
                break;
 
            case 'checkout_cart_product_add_after':
                file_put_contents($logFile, "🛒 Product added to cart\n", FILE_APPEND);
                break;
 
            case 'sales_order_place_after':
                file_put_contents($logFile, "🧾 Order placed\n", FILE_APPEND);
                break;
 
            default:
                file_put_contents($logFile, "⚠️ Unknown event: $eventName\n", FILE_APPEND);
        }
    }
}
 