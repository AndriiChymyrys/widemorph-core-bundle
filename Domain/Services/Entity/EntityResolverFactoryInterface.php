<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use ReflectionException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\BundleNotHaveEntityException;

/**
 * Class EntityResolverFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity
 *
 * @deprecated
 * Maybe it should be deleted, as we should always look on entity in App/Entity folder not in a bundle namespace.
 * It would be better for code simplicity
 */
interface EntityResolverFactoryInterface
{
    /** @var string */
    public const ENTITY_BASE_PATH = '/Infrastructure/Entity';

    /** @var string */
    public const ENTITY_PUBLIC_NAMESPACE = 'App\\Entity';

    /**
     * @param string $bundleNamespace
     *
     * @throws BundleNotHaveEntityException|ReflectionException
     */
    public function forBundle(string $bundleNamespace): self;

    /**
     * @param string $entity
     *
     * @return $this
     */
    public function attachEntity(string $entity): self;

    /**
     * @return EntityResolverInterface|null
     */
    public function get(): ?EntityResolverInterface;
}
