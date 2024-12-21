<?php

/**
  *  Copyright Dmitry Hrynchyk
  */

  declare(strict_types=1);

namespace Hrynchyk\WidgetDesigner\Block\Widget;
    
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template as BlockTemplate;

class FrontPreview extends Template implements BlockInterface
{
    public function prepareElementHtml(AbstractElement $element): AbstractElement
    {        
        $value = $element->getValue();
        $htmlId = $element->getHtmlId();
        $htmlName = $element->getName();

        /** @var BlockTemplate $uiComponent */  
        $uiComponent = $this->getLayout()->createBlock(BlockTemplate::class);
              
        $uiComponent = $uiComponent->setTemplate('Hrynchyk_WidgetDesigner::widget/ui_front_preview.phtml')
            ->setData('form_value', $value)
            ->setData('form_name', $htmlName)
            ->setData('form_id', $htmlId)
            ->toHtml();

        $element->setData('after_element_html', $uiComponent);
        $element->setValue(null);
        
        return $element;
    }
}
