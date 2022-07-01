<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\SelectDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistry;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

class DataSourceCompilePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $this->addSelectSource($container);
    }

    protected function addSelectSource(ContainerBuilder $container): void
    {
        $serviceIds = $container->findTaggedServiceIds(SelectDataSourceDefinitionInterface::SERVICE_TAG_NAME);
        $registryDefinition = $container->getDefinition(DataSourceRegistry::class);

        foreach ($serviceIds as $key => $attribute) {
            $registryDefinition->addMethodCall(
                'set',
                [
                    DataSourceRegistryInterface::SELECT_DATA_SOURCE_NAME,
                    $key,
                    $container->getDefinition($key)
                ]
            );
        }
    }
}
