<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Controller\Adminhtml\Index;

use Infrangible\BackendWidget\Model\Backend\Session;
use Infrangible\CatalogProductOptionRelation\Traits\Relation;
use Infrangible\Core\Helper\Cache;
use Infrangible\Core\Helper\Instances;
use Infrangible\Core\Helper\Registry;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Model\AbstractModel;
use Psr\Log\LoggerInterface;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Delete extends \Infrangible\BackendWidget\Controller\Backend\Object\Delete
{
    use Relation;

    /** @var Cache */
    protected $cacheHelper;

    public function __construct(
        Registry $registryHelper,
        Context $context,
        Instances $instanceHelper,
        LoggerInterface $logging,
        Session $session,
        Cache $cacheHelper
    ) {
        parent::__construct(
            $registryHelper,
            $context,
            $instanceHelper,
            $logging,
            $session
        );

        $this->cacheHelper = $cacheHelper;
    }

    protected function afterDelete(AbstractModel $object): void
    {
        parent::afterDelete($object);

        $this->cacheHelper->invalidateFullPageCache();
    }
}
