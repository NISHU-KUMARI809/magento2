<?php
namespace Nishu\HelloWorld\Cron;
 
use Psr\Log\LoggerInterface;
 
class MyCron
{
    protected $logger;
 
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
 
    public function execute()
    {
        $this->logger->info('=== Custom Cron is working ===');
        return $this;
    }
}