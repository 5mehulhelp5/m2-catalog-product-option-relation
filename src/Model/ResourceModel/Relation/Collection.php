<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Model\ResourceModel\Relation;

use Infrangible\CatalogProductOptionRelation\Model\Relation;
use Infrangible\Core\Helper\Stores;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Psr\Log\LoggerInterface;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Collection extends AbstractCollection
{
    /** @var Stores */
    protected $storeHelper;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        Stores $storeHelper,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );

        $this->storeHelper = $storeHelper;
    }

    protected function _construct(): void
    {
        $this->_init(
            Relation::class,
            \Infrangible\CatalogProductOptionRelation\Model\ResourceModel\Relation::class
        );
    }

    public function addProductFilter(int $productId): void
    {
        $this->addFieldToFilter(
            'product_id',
            $productId
        );
    }

    public function addWebsiteFilter(?int $websiteId = null): void
    {
        if (null === $websiteId) {
            try {
                $websiteId = $this->storeHelper->getWebsite()->getId();
            } catch (LocalizedException $exception) {
                $websiteId = 0;
            }
        }

        $this->addFieldToFilter(
            'website_id',
            $websiteId
        );
    }

    public function addActiveFilter(): void
    {
        $this->addFieldToFilter(
            'active',
            1
        );
    }
}
