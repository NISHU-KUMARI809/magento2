<?php
namespace Emp2407364\ContactForm\Controller\Index\Index;

/**
 * Interceptor class for @see \Emp2407364\ContactForm\Controller\Index\Index
 */
class Interceptor extends \Emp2407364\ContactForm\Controller\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Framework\UrlInterface $url)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $customerSession, $resultRedirectFactory, $messageManager, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
