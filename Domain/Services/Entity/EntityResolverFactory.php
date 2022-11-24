<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\AttachEntityException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\BundleNotHaveEntityException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\EntityResolverInitializationException;

/**
 * Class EntityResolverFactory
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services
 *
 * @deprecated
 * Maybe it should be deleted, as we should always look on entity in App/Entity folder not in a bundle namespace.
 * It would be better for code simplicity
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
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(protected Filesystem $fileSystem, protected EntityManagerInterface $entityManager)
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

        $this->entityResolver = new EntityResolver($this->entityManager);

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
