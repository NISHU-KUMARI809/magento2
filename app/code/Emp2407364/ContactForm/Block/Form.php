<?php
// Define the namespace for your custom block class
namespace Emp2407364\ContactForm\Block;
// Import Magento classes needed for block rendering and session handling
use Magento\Framework\View\Element\Template; //Base class for blocks that render HTML templates.
use Magento\Customer\Model\Session;
// Define your custom block class that extends Magento's Template block
class Form extends Template
{
   protected $_isScopePrivate = true; // Prevents block output from being cached across different sessions
   //tells that this block is private to the current session
   // Define a protected property to hold the customer session instance
    // Property to store the customer session instance
   protected $customerSession;
   // Constructor method to inject dependencies
   public function __construct(
       Template\Context $context, // Provides context for the block (layout, request, etc.)
       Session $customerSession,  // Injects customer session to access logged-in user data
       array $data = []           ////data array for the block
   ) {
    // Save the session instance for later use in other methods
       $this->customerSession = $customerSession;
       // Call the parent constructor to complete block initialization
       parent::__construct($context, $data);
   }
   // Method to check if the customer is logged in
   public function isCustomerLoggedIn()
   {
       return $this->customerSession->isLoggedIn();
   }
   // Method to get the email address of the logged-in customer
   public function getCustomerEmail()
   {
       if ($this->customerSession->isLoggedIn()) {
        // Fetch email from the customer session object
           return $this->customerSession->getCustomer()->getEmail();
       }
       // Return blank if not logged in
       return ' ';
   }
   // Method to get the ID of the logged-in customer
   public function getCustomerId()
   {
       if ($this->customerSession->isLoggedIn()) {
        // Fetch ID from the customer session object
           return $this->customerSession->getCustomer()->getId();
       }
       return ' ';
   }
}
 