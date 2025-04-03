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
class Save extends \Infrangible\BackendWidget\Controller\Backend\Object\Save
{
    use Relation;

    /** @var Cache */
    protected $cacheHelper;

    public function __construct(
        Registry $registryHelper,
        Instances $instanceHelper,
        Context $context,
        LoggerInterface $logging,
        Session $session,
        Cache $cacheHelper
    ) {
        parent::__construct(
            $registryHelper,
            $instanceHelper,
            $context,
            $logging,
            $session
        );

        $this->cacheHelper = $cacheHelper;
    }

    protected function afterSave(AbstractModel $object): void
    {
        parent::afterSave($object);

        $this->cacheHelper->invalidateFullPageCache();
    }
}
