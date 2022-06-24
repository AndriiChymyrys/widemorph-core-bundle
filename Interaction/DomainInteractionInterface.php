<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidationServiceInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Entity\EntityResolverFactoryInterface;

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
     * @return RequestValidationServiceInterface
     */
    public function getRequestValidationService(): RequestValidationServiceInterface;
}
