<?php
namespace Penekjd\Widgets\Block\Widget;

use \Magento\Framework\View\Element\Template\Context;

class ColorBlock extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'widget/color_widget.phtml';

    public function getConfigJson(): string
    {
        return $this->getData('wysiwyg_config');
    }
}
