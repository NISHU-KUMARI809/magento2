<?php
namespace Nishu\HelloWorld\Ui\Component;
 
use Magento\Ui\DataProvider\AbstractDataProvider;
use Nishu\HelloWorld\Model\ResourceModel\Contact\CollectionFactory;
 
class DataProvider extends AbstractDataProvider
{
    protected $collection;
 
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
 
    public function getData()
    {
        return $this->collection->toArray();
    }
}
 