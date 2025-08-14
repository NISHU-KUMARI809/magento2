<?php
namespace NishuCustom\CustomGraphQl\Model\Resolver;
 
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\CustomerGraphQl\Model\Customer\GetCustomer;
 
class Message implements ResolverInterface
{
    const XML_PATH_ENABLED = 'nishu_graphql/general/enabled';
 
    private ScopeConfigInterface $scopeConfig;
    private GetCustomer $getCustomer;
 
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        GetCustomer $getCustomer
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->getCustomer = $getCustomer;
    }
 
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $isEnabled = $this->scopeConfig->isSetFlag(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
 
        $isLoggedIn = false;
 
        try {
            $customer = $this->getCustomer->execute($context);
            if ($customer && $customer->getId()) {
                $isLoggedIn = true;
            }
        } catch (\Exception $e) {
            $isLoggedIn = false;
        }
 
        if ($isEnabled) {
            return $isLoggedIn ? "Hello Logged In User!" : "Hello Guest!";
        }
 
        return "Hello Same Message for All!";
    }
}
 