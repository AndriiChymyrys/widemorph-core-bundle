<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistry;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\SelectDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\CreateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\UpdateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

class DataSourceCompilePass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $this->addDataSources($container);
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    protected function addDataSources(ContainerBuilder $container): void
    {
        $sources = [
            SelectDataSourceDefinitionInterface::SERVICE_TAG_NAME => DataSourceRegistryInterface::SELECT_DATA_SOURCE_NAME,
            CreateDataSourceDefinitionInterface::SERVICE_TAG_NAME => DataSourceRegistryInterface::CREATE_DATA_SOURCE_NAME,
            UpdateDataSourceDefinitionInterface::SERVICE_TAG_NAME => DataSourceRegistryInterface::UPDATE_DATA_SOURCE_NAME,
        ];

        $registryDefinition = $container->getDefinition(DataSourceRegistry::class);

        foreach ($sources as $serviceTag => $sourceAction) {
            $serviceIds = $container->findTaggedServiceIds($serviceTag);

            foreach ($serviceIds as $key => $attribute) {
                $registryDefinition->addMethodCall(
                    'set',
                    [
                        $sourceAction,
                        $key,
                        $container->getDefinition($key)
                    ]
                );
            }
        }
    }
}
