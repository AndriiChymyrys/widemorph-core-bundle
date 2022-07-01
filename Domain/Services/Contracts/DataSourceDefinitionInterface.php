<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

interface DataSourceDefinitionInterface
{
    public function getConstraint(): null|ConstraintValidationRulesInterface;

    public function getSource(): SelectDataSourceInterface;
}
