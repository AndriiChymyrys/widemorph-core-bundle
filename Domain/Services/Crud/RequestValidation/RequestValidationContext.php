<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\RequestValidationStrategyException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy\RequestValidationStrategyInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy\ConstraintValidationStrategyInterface;

/**
 * Class RequestValidationContext
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation
 */
class RequestValidationContext implements RequestValidationContextInterface
{
    /**
     * @var ConstraintValidationStrategyInterface|RequestValidationStrategyInterface|null
     */
    protected null|ConstraintValidationStrategyInterface|RequestValidationStrategyInterface $requestValidationStrategy = null;

    /**
     * {@inheritDoc}
     */
    public function setStrategy(
        RequestValidationStrategyInterface $requestValidationStrategy
    ): self {
        $this->requestValidationStrategy = $requestValidationStrategy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(mixed $rules, InputDataInterface $inputData)
    {
        if (!$this->requestValidationStrategy || !$this->requestValidationStrategy->isSupport($rules)) {
            // check isSupport($rules) because strategy can be not supported by $rules
            throw new RequestValidationStrategyException(
                'Can not execute context with empty strategy, or strategy does not support rules'
            );
        }

        $this->requestValidationStrategy->execute($rules, $inputData);
    }
}
