<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Block\Adminhtml\Relation;

use Infrangible\CatalogProductOptionRelation\Model\Config\Source\Type;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Form extends \Infrangible\BackendWidget\Block\Form
{
    /**
     * @throws \Exception
     */
    protected function prepareFields(\Magento\Framework\Data\Form $form): void
    {
        $fieldSet = $form->addFieldset(
            'general',
            ['legend' => __('General')]
        );

        $this->addProductNameFieldWithProductOptions(
            $fieldSet,
            'product_id',
            __('Product')->render(),
            ['source_product_option_id', 'target_product_option_id'],
            true,
            true
        );

        $this->addProductOptionFieldWithTypeValues(
            $fieldSet,
            'product_id',
            'source_product_option_id',
            __('Source Product Option')->render(),
            ['source_product_option_value_id']
        );

        $this->addProductOptionTypeValueField(
            $fieldSet,
            'source_product_option_id',
            'source_product_option_value_id',
            __('Source Product Option Value')->render()
        );

        $this->addProductOptionFieldWithTypeValues(
            $fieldSet,
            'product_id',
            'target_product_option_id',
            __('Target Product Option')->render(),
            ['target_product_option_value_id']
        );

        $this->addProductOptionTypeValueField(
            $fieldSet,
            'target_product_option_id',
            'target_product_option_value_id',
            __('Target Product Option Value')->render()
        );

        $this->addOptionsClassField(
            $fieldSet,
            'type',
            __('Type')->render(),
            Type::class,
            Type::ALLOW
        );

        $this->addWebsiteSelectField(
            $fieldSet,
            'website_id'
        );

        $this->addYesNoWithDefaultField(
            $fieldSet,
            'active',
            __('Active')->render(),
            1
        );
    }
}
