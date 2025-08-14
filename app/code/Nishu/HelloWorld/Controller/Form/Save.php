<?php
namespace 
Nishu\HelloWorld\Controller\Form;
 
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Nishu\HelloWorld\Model\ContactFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
 
class Save extends Action
{
    protected $contactFactory;
    protected $resultRedirectFactory;
    protected $_objectManager;
 
    public function __construct( Context $context, ContactFactory $contactFactory,RedirectFactory $resultRedirectFactory)
    {
          $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->contactFactory = $contactFactory;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }
 
//     public function execute()
//     {
//         $data = $this->getRequest()->getPostValue();
 
//         if ($data) {
//             $model = $this->contactFactory->create();
//             $model->setData($data);
//             $model->save();
//         }
 
//         $resultRedirect = $this->resultRedirectFactory->create();
//         $resultRedirect->setUrl($this->_url->getUrl('helloworld/form/index'));
//         return $resultRedirect;
//     }
// }
 
public function execute()
    {
        $post = $this->getRequest()->getPostValue();
 
        if ($post) {
            $model = $this->contactFactory->create();
            $model->setData($post);
            $model->save();
        }
 
        if (!empty($post['name'])) {
            $firstname = $post['name'];
 
            $customer = $this->_objectManager->create(\Magento\Customer\Model\Customer::class);
            $customer->setFirstname($firstname);
            $output = $customer->getFirstname(); // plugin will affect this
 
            echo "<h2>Form Submitted!</h2>";
            echo "<p>Original Value: {$firstname}</p>";
            echo "<p>Plugin Modified Value: {$output}</p>";
        } else {
            echo "<p>No data submitted.</p>";
        }
       
        exit;
    }
}
 
 