<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource\SelectDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource\CreateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource\UpdateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource\DeleteDataSourceDefinitionInterface;

/**
 * Class MorphCoreExtension
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection
 */
class MorphCoreExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->registerAutoconfiguration($container);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources/config')
        );

        $loader->load('interaction.xml');
        $loader->load('domain.xml');
        $loader->load('services.xml');
    }

    /**
     * @param ContainerBuilder $container
     *
     * @return void
     */
    protected function registerAutoconfiguration(ContainerBuilder $container): void
    {
        $autoconfiguration = [
            SelectDataSourceDefinitionInterface::class => SelectDataSourceDefinitionInterface::SERVICE_TAG_NAME,
            CreateDataSourceDefinitionInterface::class => CreateDataSourceDefinitionInterface::SERVICE_TAG_NAME,
            UpdateDataSourceDefinitionInterface::class => UpdateDataSourceDefinitionInterface::SERVICE_TAG_NAME,
            DeleteDataSourceDefinitionInterface::class => DeleteDataSourceDefinitionInterface::SERVICE_TAG_NAME
        ];

        foreach ($autoconfiguration as $class => $tag) {
            $container->registerForAutoconfiguration($class)
                ->addTag($tag);
        }
    }
}
