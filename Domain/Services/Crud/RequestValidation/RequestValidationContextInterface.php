<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy\RequestValidationStrategyInterface;

interface RequestValidationContextInterface
{
    /**
     * @param RequestValidationStrategyInterface $requestValidationStrategy
     *
     * @return $this
     */
    public function setStrategy(RequestValidationStrategyInterface $requestValidationStrategy): self;

    /**
     * @param mixed $rules
     * @param InputDataInterface $inputData
     *
     * @return mixed
     */
    public function execute(mixed $rules, InputDataInterface $inputData);
}
