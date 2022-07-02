<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output;

/**
 * Class OutputDataFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output
 */
interface OutputDataFactoryInterface
{
    /**
     * @return OutputDataInterface
     */
    public function createOutputData(): OutputDataInterface;
}
