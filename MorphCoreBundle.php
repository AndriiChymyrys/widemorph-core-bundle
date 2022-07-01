<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection\MorphCoreExtension;
use WideMorph\Morph\Bundle\MorphCoreBundle\Infrastructure\DependencyInjection\Compiler\DataSourceCompilePass;

/**
 * Class MorphConfigBundle
 *
 * @package WideMorph\Morph\Bundle\MorphConfigBundle
 */
class MorphCoreBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new DataSourceCompilePass());
    }

    /**
     * {@inheritDoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new MorphCoreExtension();
    }
}
