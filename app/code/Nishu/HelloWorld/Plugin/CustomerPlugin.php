<?php
namespace 
Nishu\HelloWorld\Plugin;
 
use Magento\Framework\Message\ManagerInterface;
use Nishu\HelloWorld\Controller\form\Save;
 
class CustomerPlugin
{
    /**
     * @var ManagerInterface
     */
    protected $messageManager;
 
    public function __construct(ManagerInterface $messageManager)
    {
        $this->messageManager = $messageManager;
    }
 
    /**
     * Before plugin method
     */
    public function beforeExecute(Save $subject)
    {
        file_put_contents(BP . '/var/log/plugin_check.log', "BEFORE PLUGIN RAN\n", FILE_APPEND);
    }
 
    /**
     * After plugin method
     */
    public function afterExecute(Save $subject, $result)
    {
        file_put_contents(BP . '/var/log/plugin_check.log', "AFTER PLUGIN RAN\n", FILE_APPEND);
        // Add message to show in browser
        $this->messageManager->addSuccessMessage('✅ Plugin executed and this specific task');
 
        return $result;
    }
 
    /**
     * Around plugin method
     */
    public function aroundExecute(Save $subject, callable $proceed)
    {
        file_put_contents(BP . '/var/log/plugin_check.log', "AROUND PLUGIN STARTED\n", FILE_APPEND);
 
        // Execute the original method
        $result = $proceed();
 
        file_put_contents(BP . '/var/log/plugin_check.log', "AROUND PLUGIN ENDED\n", FILE_APPEND);
 
        // Add message to show in browser
        $this->messageManager->addSuccessMessage('✅ Around plugin executed successfully.');
 
        return $result;
    }
}
 
 