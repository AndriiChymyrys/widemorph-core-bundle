<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;

/**
 * Class DeleteDataSourceServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
interface DeleteDataSourceServiceInterface
{
    /**
     * @param string $sourceName
     * @param array|null $options
     *
     * @return OutputDataInterface
     */
    public function execute(string $sourceName, ?array $options = null): OutputDataInterface;
}
