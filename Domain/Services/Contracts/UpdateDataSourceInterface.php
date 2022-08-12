<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class UpdateDataSourceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface UpdateDataSourceInterface
{
    /**
     * @param InputDataCollectionInterface $inputDataCollection
     * @param mixed $target
     *
     * @return mixed
     */
    public function update(InputDataCollectionInterface $inputDataCollection, mixed $target): mixed;
}
