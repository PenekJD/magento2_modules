<?php

namespace Penekjd\Grid\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    public function _construct()
    {
        $this->_init('penekjd_demo_grid', 'entity_id');
    }
}