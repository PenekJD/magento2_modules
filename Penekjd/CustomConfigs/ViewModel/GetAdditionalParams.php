<?php

/**
  *  Copyright Dmitry Hrynchyk
  */

declare(strict_types=1);

namespace Penekjd\Widgets\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class GetAdditionalParams implements ArgumentInterface
{
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ) {
    }

    public function isModuleEnabled(): bool
    {
        return (bool) $this->getParameterByPath('penekjd_configs/general/enable');
    }

    private function getParameterByPath(string $paramName): ?string
    {
        return $this->scopeConfig->getValue($paramName, ScopeInterface::SCOPE_STORE);
    }
}
