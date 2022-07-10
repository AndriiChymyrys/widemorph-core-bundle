<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class ConstraintValidationServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation
 */
interface ConstraintValidationServiceInterface
{
    /**
     * @param mixed $rules
     * @param InputDataCollectionInterface $inputData
     *
     * @return InputDataCollectionInterface
     */
    public function validate(mixed $rules, InputDataCollectionInterface $inputData): InputDataCollectionInterface;
}