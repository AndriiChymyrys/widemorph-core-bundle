<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\InputDataCollectionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy\ConstraintValidationStrategyInterface;

interface ConstraintValidationContextInterface
{
    /**
     * @param ConstraintValidationStrategyInterface $requestValidationStrategy
     *
     * @return $this
     */
    public function setStrategy(ConstraintValidationStrategyInterface $requestValidationStrategy): self;

    /**
     * @param mixed $rules
     * @param InputDataCollectionInterface $inputData
     *
     * @return mixed
     */
    public function execute(mixed $rules, InputDataCollectionInterface $inputData);
}
