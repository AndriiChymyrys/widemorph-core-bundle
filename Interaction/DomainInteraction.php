<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormSubmit\FormSubmitServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity\EntityResolverFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder\FormBuilderServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\SelectDataSourceServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\CreateDataSourceServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\UpdateDataSourceServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\DeleteDataSourceServiceInterface;
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
     * @param CreateDataSourceServiceInterface $createDataSourceService
     * @param UpdateDataSourceServiceInterface $updateDataSourceService
     * @param DeleteDataSourceServiceInterface $deleteDataSourceService
     * @param FormBuilderServiceInterface $formBuilderService
     * @param FormSubmitServiceInterface $formSubmitService
     */
    public function __construct(
        protected readonly EntityResolverFactoryInterface $entityResolverFactory,
        protected readonly ConstraintValidationServiceInterface $constraintValidationService,
        protected readonly SelectDataSourceServiceInterface $selectDataSourceService,
        protected readonly DoctrineDataFilterContextFactoryInterface $doctrineDataFilterContextFactory,
        protected readonly CreateDataSourceServiceInterface $createDataSourceService,
        protected readonly UpdateDataSourceServiceInterface $updateDataSourceService,
        protected readonly DeleteDataSourceServiceInterface $deleteDataSourceService,
        protected readonly FormBuilderServiceInterface $formBuilderService,
        protected readonly FormSubmitServiceInterface $formSubmitService,
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

    /**
     * {@inheritDoc}
     */
    public function getCreateDataSourceService(): CreateDataSourceServiceInterface
    {
        return $this->createDataSourceService;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdateDataSourceService(): UpdateDataSourceServiceInterface
    {
        return $this->updateDataSourceService;
    }

    /**
     * {@inheritDoc}
     */
    public function getDeleteDataSourceService(): DeleteDataSourceServiceInterface
    {
        return $this->deleteDataSourceService;
    }

    /**
     * {@inheritDoc}
     */
    public function getFormBuilderService(): FormBuilderServiceInterface
    {
        return $this->formBuilderService;
    }

    /**
     * {@inheritDoc}
     */
    public function getFormSubmitService(): FormSubmitServiceInterface
    {
        return $this->formSubmitService;
    }
}
