<?php
declare(strict_types=1);


namespace Penekjd\DataPatch\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as BlockCollectionFactory;
use Magento\Cms\Model\ResourceModel\Block as BlockResource;
use Magento\Cms\Model\Block;


class FixCMSBlockContentByCode implements DataPatchInterface
{
   public function __construct(
       private ModuleDataSetupInterface $moduleDataSetup,
       private BlockResource $blockResource,
       private BlockCollectionFactory $blockCollectionFactory
   ) {
   }


   public function apply()
   {
       $this->moduleDataSetup->startSetup();


       $blockIdentifier = 'footer_links_block';


       $newContent = <<<HTML
           <ul class="footer links">
                <li class="nav item"><a href="{{store url="about-us"}}">About Dima</a></li>
                <li class="nav item"><a href="{{store url="customer-service"}}">Customer Service</a></li>
            </ul>
       HTML;


       $blockCollection = $this->blockCollectionFactory->create();
       $blockCollection->addFieldToFilter('identifier', $blockIdentifier);
       /** @var Block $block */
       $block = $blockCollection->getFirstItem();


       if ($block->getId()) {
           $block->setContent($newContent);
           $this->blockResource->save($block);
       }


       $this->moduleDataSetup->endSetup();


       return $this;
   }


   public static function getDependencies()
   {
       return [];
   }


   public function getAliases()
   {
       return [];
   }
}
