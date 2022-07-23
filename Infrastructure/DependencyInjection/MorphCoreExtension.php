<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\SelectDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\CreateDataSourceDefinitionInterface;

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
        $container->registerForAutoconfiguration(SelectDataSourceDefinitionInterface::class)
            ->addTag(SelectDataSourceDefinitionInterface::SERVICE_TAG_NAME);

        $container->registerForAutoconfiguration(CreateDataSourceDefinitionInterface::class)
            ->addTag(CreateDataSourceDefinitionInterface::SERVICE_TAG_NAME);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../../Resources/config')
        );

        $loader->load('interaction.xml');
        $loader->load('domain.xml');
    }
}
