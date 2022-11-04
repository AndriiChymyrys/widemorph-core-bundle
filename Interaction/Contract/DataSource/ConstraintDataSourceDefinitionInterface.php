<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\ConstraintValidationRulesInterface;

/**
 * Class ConstraintDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource
 */
interface ConstraintDataSourceDefinitionInterface
{
    /**
     * @return ConstraintValidationRulesInterface
     */
    public function getConstraint(): ConstraintValidationRulesInterface;
}
