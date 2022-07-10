<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry;

use WideMorph\Ims\Bundle\ImsProductBundle\Interaction\Bridge\MorphCore\SelectDataSourceDefinitionInterfaceBridge;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\DataSourceException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DataSourceDefinitionInterface;

/**
 * Class DataSourceRegistry
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry
 */
class DataSourceRegistry implements DataSourceRegistryInterface
{
    /**
     * @var array
     */
    protected array $dataSource = [];

    /**
     * {@inheritDoc}
     *
     * @throws DataSourceException
     */
    public function set(string $source, string $name, DataSourceDefinitionInterface $definition): void
    {
        $this->validateDefinition($source, $definition);

        $this->dataSource[$source][$name] = $definition;
    }

    /**
     * {@inheritDoc}
     *
     * @throws DataSourceException
     */
    public function get(string $source, string $name): DataSourceDefinitionInterface
    {
        $service = $this->dataSource[$source][$name] ?? null;

        if (!$service) {
            throw new DataSourceException(
                sprintf('Can not find "%s" source for name "%s"', $source, $name)
            );
        }

        return $service;
    }

    /**
     * @param string $source
     * @param DataSourceDefinitionInterface $definition
     *
     * @return void
     *
     * @throws DataSourceException
     */
    protected function validateDefinition(string $source, DataSourceDefinitionInterface $definition): void
    {
        if (!in_array($source, static::DATA_SOURCE_LIST)) {
            throw new DataSourceException(sprintf('Data source for name "%s" does not exists', $source));
        }

        if (
            $source === DataSourceRegistryInterface::SELECT_DATA_SOURCE_NAME &&
            !$definition instanceof SelectDataSourceDefinitionInterfaceBridge
        ) {
            throw new DataSourceException(
                sprintf(
                    'Data source "%s" should implement interface "%s"',
                    $source,
                    SelectDataSourceDefinitionInterfaceBridge::class,
                )
            );
        }
    }
}
