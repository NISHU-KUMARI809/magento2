<?php
namespace Nishu\HelloWorld\Model\Api;
 
use Nishu\HelloWorld\Api\CustomInterface;
 
class Custom implements CustomInterface
{
    public function getData()
    {
        return [
            'status'=> 'true',
            'message' => 'Hello from custom API!',
            'timestamp' => time()
        ];
    }
}