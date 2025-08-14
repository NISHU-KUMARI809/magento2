<?php

// Define the namespace for the controller
namespace Emp2407364\ContactForm\Controller\Index;

// Import necessary Magento classes
use Magento\Framework\App\Action\Action;                           // Base controller class
use Magento\Framework\App\Action\Context;                          // Provides necessary objects like request and response
use Emp2407364\ContactForm\Model\ContactFactory;                   // Factory to create Contact model instances
use Magento\Framework\Controller\Result\RedirectFactory;          // Creates redirect response
use Magento\Framework\Mail\Template\TransportBuilder;             // Used to send transactional emails
use Magento\Store\Model\StoreManagerInterface;                    // Helps retrieve store-related info
use Magento\Framework\Data\Form\FormKey\Validator as FormKeyValidator; // Validates form key for CSRF protection
use Magento\Framework\App\Config\ScopeConfigInterface;            // Access store configuration values
use Magento\Store\Model\ScopeInterface;                           // Constants for scoping config values

class FormSubmit extends Action
{
    // Declare dependencies
    protected $scopeConfig;
    protected $contactFactory;
    protected $resultRedirectFactory;
    protected $transportBuilder;
    protected $storeManager;
    protected $formKeyValidator;

    // Constructor: inject all required dependencies
    public function __construct(
        Context $context,
        ContactFactory $contactFactory,
        RedirectFactory $resultRedirectFactory,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        FormKeyValidator $formKeyValidator,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->contactFactory = $contactFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->formKeyValidator = $formKeyValidator;
        $this->scopeConfig = $scopeConfig;
    }

    // Main controller method to process POST request
    public function execute()
    {
        // Get POST data from the request
        $postData = $this->getRequest()->getPostValue();

        // Validate form key 
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__('Invalid form key. Please refresh the page.'));
            return $this->resultRedirectFactory->create()->setPath('contactform/index/index');
        }

        // Check if form was submitted with data
        if (!empty($postData)) {
            try {
                // Save contact data to the database
                $contact = $this->contactFactory->create();
                $contact->setData([
                    'customer_id' => $postData['customer_id'],
                    'customer_email' => $postData['customer_email'] ?? 'noemail@example.com',
                    'message' => $postData['message'] ?? ''
                ]);
                $contact->save();

                // Retrieve admin email from custom module config
                $adminEmail = $this->scopeConfig->getValue(
                    'contactform/settings/admin_email',
                    ScopeInterface::SCOPE_STORE
                );

                // Fallback to Magento default general email if custom config is empty
                if (!$adminEmail) {
                    $adminEmail = $this->scopeConfig->getValue(
                        'trans_email/ident_general/email',
                        ScopeInterface::SCOPE_STORE
                    );
                }

                // Get admin name (fallback to "Admin")
                $adminName = $this->scopeConfig->getValue(
                    'trans_email/ident_general/name',
                    ScopeInterface::SCOPE_STORE
                ) ?: 'Admin';

                // Prepare and send email
                $storeId = $this->storeManager->getStore()->getId(); //Retrieves the current store ID.
                //required for choosing right email template 
                $transport = $this->transportBuilder //Begins building the email using Magento’s TransportBuilder, 
                // which handles email deliver
                    ->setTemplateIdentifier('contactUsForm_email')// ID of the email template
                    ->setTemplateOptions([ 
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $storeId
                    ])
                    ->setTemplateVars([ //these are variables that will be available in the email template
                        'customer_email' => $postData['customer_email'] ?? '',
                        'message' => $postData['message'] ?? '',
                        'customer_id' => $postData['customer_id'] ?? ''
                    ])
                    ->setFrom([ //Set Sender Info
                        'email' => $postData['customer_email'] ?? $adminEmail,
                        'name' => $postData['customer_name'] ?? 'Customer'
                    ])
                    ->addTo($adminEmail, $adminName) //Set Recipient Info
                    ->getTransport();

                $transport->sendMessage(); // Send the email

                $this->messageManager->addSuccessMessage(__('Form submitted successfully!'));
                //display success message to the user on frontend 

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while saving the data: ') . $e->getMessage());
            }
        } else {
            $this->messageManager->addErrorMessage(__('No data received.'));
        }

        // Redirect back to the contact form page
        return $this->resultRedirectFactory->create()->setPath('contactform/index/index');
    }
}
