<?php
namespace Penekjd\Controllers\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Psr\Log\LoggerInterface;

class Upload extends Action implements HttpPostActionInterface
{
    
    public function __construct(
        Context $context,
        protected JsonFactory $resultJsonFactory,
        protected UploaderFactory $uploaderFactory,
        protected Filesystem $filesystem,
        protected LoggerInterface $logger,
        protected Http $request
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $myValue = $this->request->getParam('test_value');

        try {
            $filePath = '';

            
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
            $uploader = $this->uploaderFactory->create(['fileId' => 'filepath']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $result = $uploader->save($mediaDirectory . 'custom_images');

            if ($result['file']) {
                $filePath = 'custom_images' . $result['file'];
            }

            return $resultJson->setData([
                'success' => true,
                'message' => __('Image has been successfully uploaded.'),
                'image_url' => $filePath,
                'my_value' => $myValue
            ]);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return $resultJson->setData([
                'success' => false,
                'message' => __('Image upload failed. Please try again.'),
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Penekjd_Controllers::index');
    }
}
