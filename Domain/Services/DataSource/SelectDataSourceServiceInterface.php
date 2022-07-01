<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

interface SelectDataSourceServiceInterface
{
    public function execute(string $sourceName);
}
