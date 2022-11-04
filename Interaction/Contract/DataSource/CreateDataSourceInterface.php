<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class CreateDataSourceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource
 */
interface CreateDataSourceInterface
{
    /**
     * @param InputDataCollectionInterface $inputDataCollection
     *
     * @return mixed
     */
    public function create(InputDataCollectionInterface $inputDataCollection): mixed;
}
