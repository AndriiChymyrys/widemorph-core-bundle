<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

/**
 * Class SelectDataSourceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface SelectDataSourceInterface
{
    /**
     * @param InputDataCollectionInterface $inputDataCollection
     *
     * @return mixed
     */
    public function select(InputDataCollectionInterface $inputDataCollection): mixed;
}
