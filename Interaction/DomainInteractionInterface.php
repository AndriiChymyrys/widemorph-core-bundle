<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity\EntityResolverFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\ConstraintValidationServiceInterface;

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
}
