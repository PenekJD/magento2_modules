<?php
namespace Penekjd\Widgets\Block\Widget;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\Template;

class ColorBlock extends Template
{
    protected $_template = 'widget/color_widget.phtml';

    public function __construct(
        private Template\Context $context,
        private StoreManagerInterface $storeManager,
        array $data = []
    ){
        parent::__construct($context, $data);
    }

    public function getConfigJson(): string
    {
        return $this->getData('wysiwyg_config') ?? '{}';
    }

    public function getConfigImg(): ?string
    {
        $img = $this->getConfigJson();

        if (!$img) {
            return null;
        }

        $img = json_decode($img, true);

        if (!$img['image_url']) {
            return null;
        }
        $mediaUrl = $this->storeManager->getStore()
                                       ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $img['image_url'];
    }
}
