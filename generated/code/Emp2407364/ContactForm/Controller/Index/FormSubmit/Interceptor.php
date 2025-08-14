<?php
namespace Emp2407364\ContactForm\Controller\Index\FormSubmit;

/**
 * Interceptor class for @see \Emp2407364\ContactForm\Controller\Index\FormSubmit
 */
class Interceptor extends \Emp2407364\ContactForm\Controller\Index\FormSubmit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Emp2407364\ContactForm\Model\ContactFactory $contactFactory, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory, \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->___init();
        parent::__construct($context, $contactFactory, $resultRedirectFactory, $transportBuilder, $storeManager, $formKeyValidator, $scopeConfig);
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
