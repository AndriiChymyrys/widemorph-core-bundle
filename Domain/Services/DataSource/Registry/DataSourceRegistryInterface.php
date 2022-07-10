<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DataSourceDefinitionInterface;

/**
 * Class DataSourceRegistryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry
 */
interface DataSourceRegistryInterface
{
    /** @var string */
    public const SELECT_DATA_SOURCE_NAME = 'select';

    /** @var string */
    public const UPDATE_DATA_SOURCE_NAME = 'update';

    /** @var string */
    public const CREATE_DATA_SOURCE_NAME = 'create';

    /** @var string */
    public const DELETE_DATA_SOURCE_NAME = 'delete';

    /** @var string[] */
    public const DATA_SOURCE_LIST = [
        self::SELECT_DATA_SOURCE_NAME,
        self::UPDATE_DATA_SOURCE_NAME,
        self::CREATE_DATA_SOURCE_NAME,
        self::DELETE_DATA_SOURCE_NAME,
    ];

    /**
     * @param string $source
     * @param string $name
     * @param DataSourceDefinitionInterface $definition
     *
     * @return void
     */
    public function set(string $source, string $name, DataSourceDefinitionInterface $definition): void;

    /**
     * @param string $source
     * @param string $name
     *
     * @return DataSourceDefinitionInterface
     */
    public function get(string $source, string $name): DataSourceDefinitionInterface;
}
