<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class SelectDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface SelectDataSourceDefinitionInterface extends DataSourceDefinitionInterface
{
    /** @var string */
    public const SERVICE_TAG_NAME = 'select.data.source';

    /**
     * @return SelectDataSourceInterface
     */
    public function getSource(): SelectDataSourceInterface;

    /**
     * Return pagination array [page, perPage] return null if pagination don't need
     *
     * @param InputDataCollectionInterface $inputDataCollection
     *
     * @return array|null
     */
    public function getSourcePagination(InputDataCollectionInterface $inputDataCollection): ?array;
}
