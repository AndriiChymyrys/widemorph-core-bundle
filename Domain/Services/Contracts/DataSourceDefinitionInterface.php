<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

/**
 * Class DataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface DataSourceDefinitionInterface
{
    /**
     * @return ConstraintValidationRulesInterface|null
     */
    public function getConstraint(): null|ConstraintValidationRulesInterface;

    /**
     * @return SelectDataSourceInterface
     */
    public function getSource(): SelectDataSourceInterface;
}
