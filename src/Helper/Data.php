<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Helper;

use Infrangible\CatalogProductOptionRelation\Model\Relation;
use Infrangible\CatalogProductOptionRelation\Model\ResourceModel\Relation\CollectionFactory;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Data
{
    /** @var CollectionFactory */
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Relation[]
     */
    public function getProductRelations(int $productId): array
    {
        $collection = $this->collectionFactory->create();

        $collection->addProductFilter($productId);
        $collection->addWebsiteFilter();
        $collection->addActiveFilter();

        return $collection->getItems();
    }
}
