<?php

/**
 *  Copyright Dmitry Hrynchyk
*/

declare(strict_types=1);

namespace Penekjd\Grid\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InstallSchema implements InstallSchemaInterface
{
    private const TABLE_NAME = "penekjd_demo_grid";

	public function install(
        SchemaSetupInterface $setup, 
        ModuleContextInterface $context
    ){
		$installer = $setup;

		$installer->startSetup();

		if (!$installer->tableExists("penekjd_demo_grid")) {

			$table = $installer->getConnection()
                ->newTable($installer->getTable("penekjd_demo_grid"))
				->addColumn(
					'entity_id',
					Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'ID'
				)
				->addColumn(
					'name',
					Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Post Name'
				)
				->addColumn(
					'url_key',
					Table::TYPE_TEXT,
					255,
					[],
					'Post URL Key'
				)
				->addColumn(
					'content',
					Table::TYPE_TEXT,
					'64k',
					[],
					'Post Post Content'
				)
				->addColumn(
					'tags',
					Table::TYPE_TEXT,
					255,
					[],
					'Post Tags'
				)
				->addColumn(
					'status',
					Table::TYPE_INTEGER,
					1,
					[],
					'Post Status'
				)
				->addColumn(
					'image',
					Table::TYPE_TEXT,
					255,
					[],
					'Post Featured Image'
				)
				->addColumn(
					'created_at',
					Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
					'Created At'
				)->addColumn(
					'updated_at',
					Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
					'Updated At')
				->setComment('Grid Table');

			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable("penekjd_demo_grid"),
				$setup->getIdxName(
					$installer->getTable("penekjd_demo_grid"),
					['name', 'url_key', 'content', 'tags', 'image'],
					AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['name', 'url_key', 'content', 'tags', 'image'],
				AdapterInterface::INDEX_TYPE_FULLTEXT
			);

		}
		$installer->endSetup();
	}
}