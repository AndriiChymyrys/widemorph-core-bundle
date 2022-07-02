<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output;

/**
 * Class OutputDataFactory
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output
 */
class OutputDataFactory implements OutputDataFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createOutputData(): OutputDataInterface
    {
        return new OutputData();
    }
}
