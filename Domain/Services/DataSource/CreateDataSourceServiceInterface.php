<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;

/**
 * Class CreateDataSourceServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
interface CreateDataSourceServiceInterface
{
    /**
     * @param string $sourceName
     * @param array|null $input
     *
     * @return OutputDataInterface
     */
    public function execute(string $sourceName, ?array $input = null): OutputDataInterface;
}
