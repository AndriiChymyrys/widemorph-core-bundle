<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity\EntityResolverFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\SelectDataSourceServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\ConstraintValidationServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine\DoctrineDataFilterContextFactoryInterface;

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
     * @param SelectDataSourceServiceInterface $selectDataSourceService
     * @param DoctrineDataFilterContextFactoryInterface $doctrineDataFilterContextFactory
     */
    public function __construct(
        protected EntityResolverFactoryInterface $entityResolverFactory,
        protected ConstraintValidationServiceInterface $constraintValidationService,
        protected SelectDataSourceServiceInterface $selectDataSourceService,
        protected DoctrineDataFilterContextFactoryInterface $doctrineDataFilterContextFactory,
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

    /**
     * {@inheritDoc}
     */
    public function getSelectDataSourceService(): SelectDataSourceServiceInterface
    {
        return $this->selectDataSourceService;
    }

    /**
     * {@inheritDoc}
     */
    public function getDoctrineDataFilterContextFactory(): DoctrineDataFilterContextFactoryInterface
    {
        return $this->doctrineDataFilterContextFactory;
    }
}
