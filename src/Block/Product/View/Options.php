<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Block\Product\View;

use FeWeDev\Base\Arrays;
use FeWeDev\Base\Json;
use FeWeDev\Base\Variables;
use Infrangible\CatalogProductOptionRelation\Helper\Data;
use Infrangible\Core\Helper\Registry;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Options extends Template
{
    /** @var Registry */
    protected $registryHelper;

    /** @var Json */
    protected $json;

    /** @var Data */
    protected $relationHelper;

    /** @var Arrays */
    protected $arrays;

    /** @var Variables */
    protected $variables;

    /*** @var Product */
    private $product;

    public function __construct(
        Template\Context $context,
        Registry $registryHelper,
        Json $json,
        Data $relationHelper,
        Arrays $arrays,
        Variables $variables,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );

        $this->registryHelper = $registryHelper;
        $this->json = $json;
        $this->relationHelper = $relationHelper;
        $this->arrays = $arrays;
        $this->variables = $variables;
    }

    public function getProduct(): Product
    {
        if (! $this->product) {
            $this->product = $this->registryHelper->registry('current_product');

            if (! $this->product) {
                throw new \LogicException('Product is not defined');
            }
        }

        return $this->product;
    }

    public function getOptions(): array
    {
        return $this->getProduct()->getOptions();
    }

    public function getJsonConfig(): string
    {
        try {
            $productId = $this->variables->intValue($this->getProduct()->getId());
        } catch (\Exception $exception) {
            return '{}';
        }

        $relations = $this->relationHelper->getProductRelations($productId);

        $config = [];

        foreach ($relations as $relation) {
            $sourceProductOptionId = $relation->getSourceProductOptionId();
            $sourceProductOptionValueId = $relation->getSourceProductOptionValueId();
            $targetProductOptionId = $relation->getTargetProductOptionId();
            $targetProductOptionValueId = $relation->getTargetProductOptionValueId();
            $type = $relation->getType();

            if ($type === '2') {
                $config = $this->arrays->addDeepValue(
                    $config,
                    [
                        $sourceProductOptionId,
                        $sourceProductOptionValueId,
                        $targetProductOptionId,
                        $targetProductOptionValueId
                    ],
                    $type
                );
            }

            $config = $this->arrays->addDeepValue(
                $config,
                [
                    $targetProductOptionId,
                    $targetProductOptionValueId,
                    $sourceProductOptionId,
                    $sourceProductOptionValueId
                ],
                $type
            );
        }

        return $this->json->encode($config);
    }
}
