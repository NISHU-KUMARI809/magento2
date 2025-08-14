<?php
namespace Nishu\HelloWorld\Controller\Form\Save;

/**
 * Interceptor class for @see \Nishu\HelloWorld\Controller\Form\Save
 */
class Interceptor extends \Nishu\HelloWorld\Controller\Form\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Nishu\HelloWorld\Model\ContactFactory $contactFactory, \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory)
    {
        $this->___init();
        parent::__construct($context, $contactFactory, $resultRedirectFactory);
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
