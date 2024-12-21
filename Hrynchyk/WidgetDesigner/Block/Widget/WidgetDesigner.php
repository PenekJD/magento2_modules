<?php

/**
  *  Copyright Dmitry Hrynchyk
*/

declare(strict_types=1);

namespace Hrynchyk\WidgetDesigner\Block\Widget;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Element\Template;

class WidgetDesigner extends Template
{
    protected $_template = 'widget/widget-designer.phtml';
}