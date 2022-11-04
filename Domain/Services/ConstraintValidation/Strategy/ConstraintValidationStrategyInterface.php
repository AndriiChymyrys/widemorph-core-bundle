<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\ConstraintValidationRulesInterface;

/**
 * Class ConstraintValidationStrategyInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy
 */
interface ConstraintValidationStrategyInterface extends ValidationStrategyInterface
{
    /**
     * @param ConstraintValidationRulesInterface $rules
     * @param InputDataCollectionInterface $inputData
     *
     * @return void
     */
    public function execute(ConstraintValidationRulesInterface $rules, InputDataCollectionInterface $inputData): void;
}
