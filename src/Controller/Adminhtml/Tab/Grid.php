<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Controller\Adminhtml\Tab;

use Infrangible\CatalogProductOptionRelation\Traits\Relation;
use Infrangible\CatalogProductOptionRelation\Traits\RelationTab;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Grid extends \Infrangible\BackendWidget\Controller\Backend\Object\Tab\Grid
{
    use Relation;
    use RelationTab;
}
