<?php
namespace 
Nishu\HelloWorld\Controller\Form1Plugin;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
 
class Save extends Action
{
    protected $_objectManager;
 
    public function __construct(Context $context)
    {
        parent::__construct($context);
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }
 
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
 
        if (!empty($post['firstname'])) {
            $firstname = $post['firstname'];
 
            $customer = $this->_objectManager->create(\Magento\Customer\Model\Customer::class);
            $customer->setFirstname($firstname);
            $output = $customer->getFirstname(); // plugin will affect this
 
            echo "<h2>Form Submitted!</h2>";
            echo "<p>Original Value: {$firstname}</p>";
            echo "<p>Plugin Modified Value: {$output}</p>";
        } else {
            echo "<p>No data submitted.</p>";
        }
 
        exit;
    }
}
 