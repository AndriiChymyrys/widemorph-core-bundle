<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry;

use WideMorph\Ims\Bundle\ImsProductBundle\Interaction\Bridge\MorphCore\SelectDataSourceDefinitionInterfaceBridge;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\DataSourceException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DataSourceDefinitionInterface;

class DataSourceRegistry implements DataSourceRegistryInterface
{
    protected array $dataSource = [];

    public function set(string $source, string $name, DataSourceDefinitionInterface $definition): void
    {
        $this->validateDefinition($source, $definition);

        $this->dataSource[$source][$name] = $definition;
    }

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

    protected function validateDefinition(string $source, DataSourceDefinitionInterface $definition)
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
