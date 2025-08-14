<?php

// Define the namespace for the custom controller
namespace Emp2407364\ContactForm\Controller\Index;

// Import necessary Magento classes
use Magento\Framework\App\Action\Action;                      // Base controller class
use Magento\Framework\App\Action\Context;                     // Context object for controllers
use Magento\Framework\View\Result\PageFactory;                // Used to generate a page result
use Magento\Customer\Model\Session;                           // Used to access customer session data
use Magento\Framework\Controller\Result\RedirectFactory;      // Used to create redirect responses
use Magento\Framework\Message\ManagerInterface;               // For displaying flash messages
use Magento\Framework\UrlInterface;                           // For URL generation

// Define the controller class
class Index extends Action
{
    //These are essentially variables that store important services (objects)
    //  which the controller uses to perform its tasks.
    protected $resultPageFactory;
    protected $customerSession;
    protected $resultRedirectFactory;
    protected $messageManager;
    protected $url;

    // Constructor: inject required dependencies using Magento's DI mechanism
    public function __construct(
        Context $context,                           // Provides request, response, and other objects
        PageFactory $resultPageFactory,             // For creating page results
        Session $customerSession,                   // Customer session to check login status
        RedirectFactory $resultRedirectFactory,     // Factory to create redirects
        ManagerInterface $messageManager,           // Displays messages on frontend
        UrlInterface $url  
        //constructor parameters                         // Used to get the current and login URLs
    ) {
        // Call parent constructor to initialize base controller functionality
        parent::__construct($context);

        // Assign injected dependencies to class psroperties
        $this->resultPageFactory = $resultPageFactory;
        $this->customerSession = $customerSession;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->messageManager = $messageManager;
        $this->url = $url;
    }

    // Main controller action method (executed when the route is accessed)
    public function execute()
    {
        // Check if customer is NOT logged in
        if (!$this->customerSession->isLoggedIn()) {

            // Show a notice message on the frontend prompting user to log in
            $this->messageManager->addNoticeMessage(__('Please log in to access the contact form.'));

            // Create a redirect result object use this object to send the user to a different URL
            $resultRedirect = $this->resultRedirectFactory->create();

            // Get the current page URL (contact form)
            $currentUrl = $this->url->getUrl('contactform/index/index');

            // Generate login URL with referer set to current page (encoded)
            $loginUrl = $this->url->getUrl('customer/account/login', [
                'referer' => base64_encode($currentUrl)
            ]);

            // Set redirect URL to login page
            $resultRedirect->setUrl($loginUrl);

            // Return the redirect result — takes user to login page
            return $resultRedirect;
        }

        // If user IS logged in, show the contact form page
        return $this->resultPageFactory->create();
    }
}
