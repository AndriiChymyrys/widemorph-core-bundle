<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use Symfony\Component\Filesystem\Filesystem;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\AttachEntityException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\BundleNotHaveEntityException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\EntityResolverInitializationException;

/**
 * Class EntityResolverFactory
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services
 */
class EntityResolverFactory implements EntityResolverFactoryInterface
{
    /**
     * @var EntityResolverInterface|null
     */
    protected ?EntityResolverInterface $entityResolver = null;

    /**
     * @var string
     */
    protected string $entityPath;

    /**
     * @param Filesystem $fileSystem
     */
    public function __construct(protected Filesystem $fileSystem)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function forBundle(string $bundleNamespace): self
    {
        $reflection = new \ReflectionClass($bundleNamespace);

        $bundlePath = dirname($reflection->getFileName());

        $this->entityPath = $bundlePath . static::ENTITY_BASE_PATH;

        if (!$this->fileSystem->exists($this->entityPath)) {
            throw new BundleNotHaveEntityException($bundleNamespace);
        }

        $this->entityResolver = new EntityResolver();

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws AttachEntityException|EntityResolverInitializationException
     */
    public function attachEntity(string $entity): self
    {
        if (!$this->entityResolver) {
            throw new EntityResolverInitializationException();
        }

        $entityNamespace = static::ENTITY_PUBLIC_NAMESPACE . '\\' . str_replace('/', '\\', $entity);

        $this->checkEntity($entity);

        $this->entityResolver->attach($entity, $entityNamespace);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(): ?EntityResolverInterface
    {
        return $this->entityResolver;
    }

    /**
     * @param string $entity
     *
     * @return void
     *
     * @throws AttachEntityException
     */
    protected function checkEntity(string $entity): void
    {
        $path = sprintf('%s/%s.php', $this->entityPath, $entity);

        if (!$this->fileSystem->exists($path)) {
            throw new AttachEntityException(
                sprintf('Entity "%s" not found in path "%s"', $entity, $this->entityPath)
            );
        }
    }
}
