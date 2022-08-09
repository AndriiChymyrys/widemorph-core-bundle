<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;

/**
 * Class UpdateDataSourceServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
interface UpdateDataSourceServiceInterface
{
    /**
     * @param string $sourceName
     * @param array|null $input
     * @param array|null $options
     *
     * @return OutputDataInterface
     */
    public function execute(string $sourceName, ?array $input = null, ?array $options = []): OutputDataInterface;
}
