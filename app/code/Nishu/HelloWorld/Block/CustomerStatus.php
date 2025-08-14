<?php
namespace Nishu\HelloWorld\Block;
 
use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
 
class CustomerStatus extends Template
{
    // Prevents Magento from caching this block (important for dynamic login info)
    //Setting $_isScopePrivate = true ensures that the block's content is generated fresh for each user.
    protected $_isScopePrivate = true;
 
    protected $customerSession;
    //The customerSession object provides access to the customer's session data, such as whether they are logged in and their account details.
 
    public function __construct(
        Template\Context $context,
        // Template\Context is a helper class in Magento 2 that bundles together several commonly used objects and services for blocks.
        Session $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }
 
    public function isLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }
 
    public function getCustomerName()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getCustomer()->getFirstname();
        }
        return '';
    }
}
 
 