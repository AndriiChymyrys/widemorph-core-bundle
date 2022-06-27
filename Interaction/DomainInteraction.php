<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity\EntityResolverFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\ConstraintValidationServiceInterface;

/**
 * Class DomainInteraction
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction
 */
class DomainInteraction implements DomainInteractionInterface
{
    /**
     * @param EntityResolverFactoryInterface $entityResolverFactory
     * @param ConstraintValidationServiceInterface $constraintValidationService
     */
    public function __construct(
        protected EntityResolverFactoryInterface $entityResolverFactory,
        protected ConstraintValidationServiceInterface $constraintValidationService
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function getEntityResolverFactory(): EntityResolverFactoryInterface
    {
        return $this->entityResolverFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function getConstraintValidationService(): ConstraintValidationServiceInterface
    {
        return $this->constraintValidationService;
    }
}
