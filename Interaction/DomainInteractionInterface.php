<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\SelectDataSourceServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity\EntityResolverFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\CreateDataSourceServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\ConstraintValidationServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine\DoctrineDataFilterContextFactoryInterface;

/**
 * Class DomainInteractionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction
 */
interface DomainInteractionInterface
{
    /**
     * @return EntityResolverFactoryInterface
     */
    public function getEntityResolverFactory(): EntityResolverFactoryInterface;

    /**
     * @return ConstraintValidationServiceInterface
     */
    public function getConstraintValidationService(): ConstraintValidationServiceInterface;

    /**
     * @return SelectDataSourceServiceInterface
     */
    public function getSelectDataSourceService(): SelectDataSourceServiceInterface;

    /**
     * @return DoctrineDataFilterContextFactoryInterface
     */
    public function getDoctrineDataFilterContextFactory(): DoctrineDataFilterContextFactoryInterface;

    /**
     * @return CreateDataSourceServiceInterface
     */
    public function getCreateDataSourceService(): CreateDataSourceServiceInterface;
}
