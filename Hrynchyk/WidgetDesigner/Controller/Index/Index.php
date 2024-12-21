<?php

/**
  *  Copyright Dmitry Hrynchyk
*/

declare(strict_types=1);

namespace Hrynchyk\WidgetDesigner\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private $resultPageFactory;
    
    public function __construct(PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}