<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\AttachEntityException;

/**
 * Class EntityResolver
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services
 *
 * @deprecated
 * Maybe it should be deleted, as we should always look on entity in App/Entity folder not in a bundle namespace.
 * It would be better for code simplicity
 */
class EntityResolver implements EntityResolverInterface
{
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(protected EntityManagerInterface $entityManager)
    {
    }

    /**
     * @var array
     */
    protected array $entities;

    /**
     * {@inheritDoc}
     */
    public function attach(string $entityName, string $entityNamespace): self
    {
        $this->entities[$entityName] = $entityNamespace;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws AttachEntityException
     */
    public function getEntityName(string $entityName): string
    {
        if (!isset($this->entities[$entityName])) {
            throw new AttachEntityException(
                sprintf(
                    'Entity %s not found in attached entities. Attached are "%s"',
                    $entityName,
                    implode(',', array_keys($this->entities))
                )
            );
        }

        return $this->entities[$entityName];
    }

    /**
     * {@inheritDoc}
     *
     * @throws AttachEntityException
     */
    public function getEntityRepository(string $entityName): EntityRepository
    {
        $entity = $this->getEntityName($entityName);

        return $this->entityManager->getRepository($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}
