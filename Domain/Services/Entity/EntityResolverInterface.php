<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class EntityResolverInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity
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
}
