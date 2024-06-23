<?php
namespace Penekjd\DataPatch\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class FixCMSCodeByDataBase implements DataPatchInterface
{

    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup
    ) {
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $this->moduleDataSetup->getConnection()->query(
            "UPDATE cms_block SET identifier = CONCAT(identifier, '_updated') WHERE identifier LIKE 'my_store_%'"
        );
        $this->moduleDataSetup->endSetup();
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
