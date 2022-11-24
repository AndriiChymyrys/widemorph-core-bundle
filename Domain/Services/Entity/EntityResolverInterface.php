<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class EntityResolverInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity
 *
 * @deprecated
 * Maybe it should be deleted, as we should always look on entity in App/Entity folder not in a bundle namespace.
 * It would be better for code simplicity
 */
interface EntityResolverInterface
{
    /**
     * @param string $entityName
     * @param string $entityNamespace
     *
     * @return $this
     */
    public function attach(string $entityName, string $entityNamespace): self;

    /**
     * @param string $entityName
     *
     * @return string
     */
    public function getEntityName(string $entityName): string;

    /**
     * @param string $entityName
     *
     * @return EntityRepository
     */
    public function getEntityRepository(string $entityName): EntityRepository;

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;
}
