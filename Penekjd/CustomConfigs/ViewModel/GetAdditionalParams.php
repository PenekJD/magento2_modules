<?php
namespace Penekjd\Widgets\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class GetAdditionalParams implements ArgumentInterface
{
    public function __construct(
        protected ScopeConfigInterface $scopeConfig
    ) {
    }

    public function getRequestParam($paramName)
    {
        return $this->scopeConfig->getValue('penekjd_configs/general/enable', ScopeInterface::SCOPE_STORE);
    }

}
