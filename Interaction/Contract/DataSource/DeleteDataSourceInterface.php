<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class DeleteDataSourceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource
 */
interface DeleteDataSourceInterface
{
    /**
     * @param InputDataCollectionInterface $inputDataCollection
     * @param mixed $target
     *
     * @return mixed
     */
    public function delete(InputDataCollectionInterface $inputDataCollection, mixed $target): mixed;
}
