<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionRelation\Traits;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
trait Relation
{
    protected function getModuleKey(): string
    {
        return 'Infrangible_CatalogProductOptionRelation';
    }

    protected function getResourceKey(): string
    {
        return 'infrangible_catalogproductoptionrelation';
    }

    protected function getMenuKey(): string
    {
        return 'infrangible_catalogproductoptionrelation_manage';
    }

    protected function getObjectName(): string
    {
        return 'Relation';
    }

    protected function getObjectField(): string
    {
        return 'id';
    }

    protected function getTitle(): string
    {
        return __('Product Option Relation')->render();
    }

    protected function allowAdd(): bool
    {
        return true;
    }

    protected function allowEdit(): bool
    {
        return true;
    }

    protected function allowView(): bool
    {
        return false;
    }

    protected function allowDelete(): bool
    {
        return true;
    }

    protected function allowMassDelete(): bool
    {
        return true;
    }

    protected function getObjectNotFoundMessage(): string
    {
        return __('Unable to find the relation with id: %d!')->render();
    }

    protected function getObjectCreatedMessage(): string
    {
        return __('The relation has been created.')->render();
    }

    protected function getObjectUpdatedMessage(): string
    {
        return __('The relation has been saved.')->render();
    }

    protected function getObjectDeletedMessage(): string
    {
        return __('The relation has been deleted.')->render();
    }

    protected function getObjectsDeletedMessage(): string
    {
        return __('The relations have been deleted.')->render();
    }
}
