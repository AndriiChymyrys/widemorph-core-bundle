<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DataSourceDefinitionInterface;

interface DataSourceRegistryInterface
{
    public const SELECT_DATA_SOURCE_NAME = 'select';
    public const UPDATE_DATA_SOURCE_NAME = 'update';
    public const CREATE_DATA_SOURCE_NAME = 'create';
    public const DELETE_DATA_SOURCE_NAME = 'delete';

    public const DATA_SOURCE_LIST = [
        self::SELECT_DATA_SOURCE_NAME,
        self::UPDATE_DATA_SOURCE_NAME,
        self::CREATE_DATA_SOURCE_NAME,
        self::DELETE_DATA_SOURCE_NAME,
    ];

    public function set(string $source, string $name, DataSourceDefinitionInterface $definition): void;

    public function get(string $source, string $name): DataSourceDefinitionInterface;
}
