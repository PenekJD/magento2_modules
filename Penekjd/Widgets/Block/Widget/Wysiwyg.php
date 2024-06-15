<?php
namespace Penekjd\Widgets\Block\Widget;
    
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template as BlockTemplate;

class Wysiwyg extends Template implements BlockInterface
{

    public function prepareElementHtml(AbstractElement $element)
    {        
        $value = $element->getValue();
        $htmlId = $element->getHtmlId();
        $htmlName = $element->getName();

        $uiComponent = $this->getLayout()
                        ->createBlock(BlockTemplate::class)
                        ->setData('form_value', $value)
                        ->setData('form_name', $htmlName)
                        ->setData('form_id', $htmlId)
                        ->setTemplate('Penekjd_Widgets::widget/ui_color_widget.phtml')
                        ->toHtml();

        $element->setData('after_element_html', $uiComponent);
        $element->setValue(null);
        return $element;
    }
}
