<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class SelectDataSourceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface SelectDataSourceInterface
{
    /**
     * @param InputDataCollectionInterface $inputDataCollection
     * @param array|null $pagination Pagination array [page, perPage]
     *
     * @return mixed
     */
    public function select(InputDataCollectionInterface $inputDataCollection, ?array $pagination = null): mixed;
}
