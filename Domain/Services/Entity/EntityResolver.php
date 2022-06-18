<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\AttachEntityException;

/**
 * Class EntityResolver
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services
 */
class EntityResolver implements EntityResolverInterface
{
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
     */
    public function getEntityName(string $entityName): string
    {
        if (!isset($this->entities[$entityName])) {
            throw new AttachEntityException(sprintf('Entity %s not found in attached entities', $entityName));
        }

        return $this->entities[$entityName];
    }
}
