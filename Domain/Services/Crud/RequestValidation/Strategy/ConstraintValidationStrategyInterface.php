<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\ConstraintValidationRulesInterface;

/**
 * Class ConstraintValidationStrategyInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy
 */
interface ConstraintValidationStrategyInterface extends RequestValidationStrategyInterface
{
    /**
     * @param ConstraintValidationRulesInterface $rules
     * @param InputDataInterface $inputData
     *
     * @return void
     */
    public function execute(ConstraintValidationRulesInterface $rules, InputDataInterface $inputData): void;
}
