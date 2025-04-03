<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Block\Adminhtml\Relation\Tab;

use Infrangible\BackendWidget\Block\Grid\Tab;
use Infrangible\CatalogProductOptionRelation\Model\Config\Source\Type;
use Magento\Framework\Data\Collection\AbstractDb;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Grid extends Tab
{
    protected function prepareCollection(AbstractDb $collection): void
    {
    }

    /**
     * @throws \Exception
     */
    protected function prepareFields(): void
    {
        $this->addProductOptionColumn(
            'source_product_option_id',
            __('Source Product Option')->render()
        );

        $this->addProductOptionValueColumn(
            'source_product_option_value_id',
            __('Source Product Option Value')->render()
        );

        $this->addProductOptionColumn(
            'target_product_option_id',
            __('Target Product Option')->render()
        );

        $this->addProductOptionValueColumn(
            'target_product_option_value_id',
            __('Target Product Option Value')->render()
        );

        $this->addOptionsClassColumn(
            'type',
            __('Type')->render(),
            Type::class
        );

        $this->addWebsiteNameColumn('website_id');

        $this->addYesNoColumn(
            'active',
            __('Active')->render()
        );
    }
}
