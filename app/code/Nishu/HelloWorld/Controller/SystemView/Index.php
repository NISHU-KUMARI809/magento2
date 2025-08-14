<?php
namespace Nishu\HelloWorld\Controller\SystemView;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Store\Model\ScopeInterface;
 
class Index extends Action
{
    protected $scopeConfig;
 
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }
 
    public function execute()
    {
        // Create raw response
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
 
        // Fetch config values from admin (Stores > Configuration)
        $isEnabled = $this->scopeConfig->isSetFlag(
            'helloworld/general/enable',
            ScopeInterface::SCOPE_STORE
        );

        $message = $this->scopeConfig->getValue(
            'helloworld/general/display_text',
            ScopeInterface::SCOPE_STORE
        );

        $email = $this->scopeConfig->getValue(
            'helloworld/general/feedback_email',
            ScopeInterface::SCOPE_STORE
        );

        $visibility = $this->scopeConfig->isSetFlag(
            'helloworld/general/feedback_visibility',
            ScopeInterface::SCOPE_STORE
        );

        $limit = $this->scopeConfig->getValue(
            'helloworld/general/feedback_limit',
            ScopeInterface::SCOPE_STORE
        );

        // Output based on enable config
        if ($isEnabled) {
            $result->setContents(
                "Customer Management is enabled!!<br>" .
                "Message: " . $message . "<br>" .
                "Feedback Email: " . $email . "<br>" .
                "Feedback Visibility: " . ($visibility ? "Enabled" : "Disabled") . "<br>" .
                "Feedback Limit: " . $limit
            );
        } else {
            $result->setContents("Customer Management is disabled!!");
        }
 
        return $result;
    }
}
 