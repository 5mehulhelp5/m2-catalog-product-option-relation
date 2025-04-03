<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Traits;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
trait RelationTab
{
    protected function getParentObjectKey(): string
    {
        return 'product_id';
    }

    protected function getParentObjectValueKey(): string
    {
        return 'id';
    }
}
