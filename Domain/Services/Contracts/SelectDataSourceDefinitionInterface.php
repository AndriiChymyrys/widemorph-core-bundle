<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

interface SelectDataSourceDefinitionInterface extends DataSourceDefinitionInterface
{
    public const SERVICE_TAG_NAME = 'select.data.source';
}
