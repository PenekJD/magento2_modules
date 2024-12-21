<?php

declare(strict_types=1);

namespace Penekjd\Grid\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Penekjd_Grid::edit';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        if (!$id) {
            $this->messageManager->addErrorMessage(__('This record no longer exists.'));
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Penekjd_Grid::menu_item');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Record'));

        return $resultPage;
    }
}