<?php
declare(strict_types=1);


// phpcs:disable Generic.Files.LineLength


namespace Vendic\DataPatches\Setup\Patch\Data;


use Magento\Framework\App\Area;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Widget\Model\ResourceModel\Widget\Instance as WidgetInstanceResource;
use Magento\Widget\Model\Widget\InstanceFactory as WidgetInstanceFactory;
use Magento\Framework\App\State;


class CreateWidgetDataPatch implements DataPatchInterface
{
   public function __construct(
       /* @phpstan-ignore-next-line */ // Parameter $widgetFactory has invalid type
       private WidgetInstanceFactory $widgetFactory,
       private WidgetInstanceResource $widgetInstanceResource,
       private State $state,
       private ResourceConnection $connection,
       private DirectoryList $directoryList,
       private File $filesystemIo
   ) {
   }


   public static function getDependencies(): array
   {
       return [];
   }


   public function getAliases(): array
   {
       return [];
   }


   public function apply(): DataPatchInterface
   {

        /* TODO: Fix patch to work */
        return $this;
        /* END TODO */

       try {
           $this->state->getAreaCode();
       } catch (LocalizedException $exception) {
           $this->state->setAreaCode(Area::AREA_ADMINHTML);
       }


       $this->createContactUsProductDetailPageWidget();


       return $this;
   }


   public function createContactUsProductDetailPageWidget(): void
   {
       $imagePath = __DIR__ . '/../../../assets/contact-us-bg-image.png';
       $targetPath = $this->getRootDir() . '/pub/media/wysiwyg/contact-us-bg-image.png';
       $this->filesystemIo->cp($imagePath, $targetPath);


       /** @var WidgetInstance $widget */
       /* @phpstan-ignore-next-line */ // Call to method create() on an unknown class
       $widget = $this->widgetFactory->create();


       $parameters = [
           "title" => "Heb je een vraag over dit product?",
           "description" => "Wij staan voor je klaar om voor jou het juiste product te vinden!",
           "phone" => "033-2985934",
           "chat_title" => "Start chat",
           "chat_url" => "https://wa.me/31619485476",
           "image" => "wysiwyg/contact-us-bg-image.png"
       ];


       $widgetData = [
           // phpcs:ignore
           'instance_type' => 'Vendic\CustomWidgets\Block\Widget\ContactUs',
           'theme_id' => $this->getThemeId(),
           'title' => 'Contact Us: Product detail page',
           'store_ids' => '0',
           'widget_parameters' => json_encode($parameters),
           'sort_order' => 0,
           'page_groups' => [[
               'page_group' => 'pages',
               'pages' => [
                   'page_id' => null,
                   'layout_handle' => 'catalog_product_view',
                   'block' => 'product.info.additional-info',
                   'for' => 'all'
               ]
           ]]
       ];
       $widget->addData($widgetData);
       $this->widgetInstanceResource->save($widget);
   }


   private function getThemeId(): int
   {
       $adapter = $this->connection->getConnection();
       $select = $adapter->select()
                         ->from('theme', 'theme_id')
                         ->where('code = ?', 'Vendic/hyva-bowork');


       return (int)$adapter->query($select)->fetchColumn();
   }


   private function getRootDir(): string
   {
       return $this->directoryList->getRoot();
   }
}
