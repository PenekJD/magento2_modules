<?php

/**
  *  Copyright Dmitry Hrynchyk
  */

declare(strict_types=1);

namespace Penekjd\Grid\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
	public function __construct(
		Context $context,
		private PageFactory $resultPageFactory
	){
		parent::__construct($context);
	}

	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Grid Samples')));

		return $resultPage;
	}
}