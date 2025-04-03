<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 *
 * @method string getSourceProductOptionId()
 * @method string getSourceProductOptionValueId()
 * @method string getTargetProductOptionId()
 * @method string getTargetProductOptionValueId()
 * @method string getType()
 */
class Relation extends AbstractModel
{
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Relation::class);
    }
}
