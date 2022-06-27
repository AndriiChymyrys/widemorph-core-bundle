<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\InputDataCollectionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\ConstraintValidationStrategyException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy\ValidationStrategyInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy\ConstraintValidationStrategyInterface;

/**
 * Class RequestValidationContext
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation
 */
class ConstraintValidationContext implements ConstraintValidationContextInterface
{
    /**
     * @var ConstraintValidationStrategyInterface|ValidationStrategyInterface|null
     */
    protected null|ConstraintValidationStrategyInterface|ValidationStrategyInterface $requestValidationStrategy = null;

    /**
     * {@inheritDoc}
     */
    public function setStrategy(
        ConstraintValidationStrategyInterface $requestValidationStrategy
    ): self {
        $this->requestValidationStrategy = $requestValidationStrategy;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(mixed $rules, InputDataCollectionInterface $inputData)
    {
        if (!$this->requestValidationStrategy || !$this->requestValidationStrategy->isSupport($rules)) {
            // check isSupport($rules) because strategy can be not supported by $rules
            throw new ConstraintValidationStrategyException(
                'Can not execute context with empty strategy, or strategy does not support rules'
            );
        }

        $this->requestValidationStrategy->execute($rules, $inputData);
    }
}
