<?php

declare(strict_types=1);

namespace Penekjd\Grid\Ui\DataProvider\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Penekjd\Grid\Model\ResourceModel\Post\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        CollectionFactory $collectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        $items = $this->collection->getItems();
        $data = [];
        foreach ($items as $item) {
            $data[$item->getId()] = $item->getData();
        }
        return $data;
    }
}