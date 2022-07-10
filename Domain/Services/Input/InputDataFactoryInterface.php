<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input;

/**
 * Class InputDataFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input
 */
interface InputDataFactoryInterface
{
    /**
     * @return InputDataCollectionInterface
     */
    public function fromRequest(): InputDataCollectionInterface;

    /**
     * @param array $data
     *
     * @return InputDataCollectionInterface
     */
    public function fromArray(array $data): InputDataCollectionInterface;
}
