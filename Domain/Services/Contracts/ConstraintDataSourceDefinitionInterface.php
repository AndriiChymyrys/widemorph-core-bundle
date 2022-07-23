<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

/**
 * Class ConstraintDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface ConstraintDataSourceDefinitionInterface
{
    /**
     * @return ConstraintValidationRulesInterface
     */
    public function getConstraint(): ConstraintValidationRulesInterface;
}
