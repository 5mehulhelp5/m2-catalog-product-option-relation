<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Setup;

use Exception;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @throws Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $connection = $setup->getConnection();

        $productOptionRelationTableName = $setup->getTable('catalog_product_option_relation');

        if (! $setup->tableExists($productOptionRelationTableName)) {
            $productEntityTableName = $setup->getTable('catalog_product_entity');
            $productOptionTableName = $setup->getTable('catalog_product_option');
            $productOptionValueTableName = $setup->getTable('catalog_product_option_type_value');
            $websiteTableName = $connection->getTableName('store_website');

            $productOptionRelationTable = $connection->newTable($productOptionRelationTableName);

            $productOptionRelationTable->addColumn(
                'id',
                Table::TYPE_INTEGER,
                10,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
            );
            $productOptionRelationTable->addColumn(
                'product_id',
                Table::TYPE_INTEGER,
                10,
                ['unsigned' => true, 'nullable' => false]
            );
            $productOptionRelationTable->addColumn(
                'source_product_option_id',
                Table::TYPE_INTEGER,
                10,
                ['unsigned' => true, 'nullable' => true]
            );
            $productOptionRelationTable->addColumn(
                'source_product_option_value_id',
                Table::TYPE_INTEGER,
                10,
                ['unsigned' => true, 'nullable' => true]
            );
            $productOptionRelationTable->addColumn(
                'target_product_option_id',
                Table::TYPE_INTEGER,
                10,
                ['unsigned' => true, 'nullable' => true]
            );
            $productOptionRelationTable->addColumn(
                'target_product_option_value_id',
                Table::TYPE_INTEGER,
                10,
                ['unsigned' => true, 'nullable' => true]
            );
            $productOptionRelationTable->addColumn(
                'type',
                Table::TYPE_SMALLINT,
                1,
                ['nullable' => false, 'unsigned' => true, 'default' => 1]
            );
            $productOptionRelationTable->addColumn(
                'website_id',
                Table::TYPE_SMALLINT,
                5,
                ['nullable' => false, 'unsigned' => true, 'default' => 0]
            );
            $productOptionRelationTable->addColumn(
                'active',
                Table::TYPE_SMALLINT,
                1,
                ['nullable' => false, 'unsigned' => true, 'default' => 0]
            );
            $productOptionRelationTable->addColumn(
                'created_at',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false, 'default' => '0000-00-00 00:00:00']
            );
            $productOptionRelationTable->addColumn(
                'updated_at',
                Table::TYPE_DATETIME,
                null,
                ['nullable' => false, 'default' => '0000-00-00 00:00:00']
            );

            $productOptionRelationTable->addForeignKey(
                $setup->getFkName(
                    $productOptionRelationTableName,
                    'product_id',
                    $productEntityTableName,
                    'entity_id'
                ),
                'product_id',
                $productEntityTableName,
                'entity_id',
                Table::ACTION_CASCADE
            );

            $productOptionRelationTable->addForeignKey(
                $setup->getFkName(
                    $productOptionRelationTableName,
                    'source_product_option_id',
                    $productOptionTableName,
                    'option_id'
                ),
                'source_product_option_id',
                $productOptionTableName,
                'option_id',
                Table::ACTION_CASCADE
            );

            $productOptionRelationTable->addForeignKey(
                $setup->getFkName(
                    $productOptionRelationTableName,
                    'source_product_option_value_id',
                    $productOptionValueTableName,
                    'option_type_id'
                ),
                'source_product_option_value_id',
                $productOptionValueTableName,
                'option_type_id',
                Table::ACTION_CASCADE
            );

            $productOptionRelationTable->addForeignKey(
                $setup->getFkName(
                    $productOptionRelationTableName,
                    'target_product_option_id',
                    $productOptionTableName,
                    'option_id'
                ),
                'target_product_option_id',
                $productOptionTableName,
                'option_id',
                Table::ACTION_CASCADE
            );

            $productOptionRelationTable->addForeignKey(
                $setup->getFkName(
                    $productOptionRelationTableName,
                    'target_product_option_value_id',
                    $productOptionValueTableName,
                    'option_type_id'
                ),
                'target_product_option_value_id',
                $productOptionValueTableName,
                'option_type_id',
                Table::ACTION_CASCADE
            );

            $productOptionRelationTable->addForeignKey(
                $setup->getFkName(
                    $productOptionRelationTableName,
                    'website_id',
                    $websiteTableName,
                    'website_id'
                ),
                'website_id',
                $websiteTableName,
                'website_id',
                Table::ACTION_CASCADE
            );

            $connection->createTable($productOptionRelationTable);
        }

        $setup->endSetup();
    }
}