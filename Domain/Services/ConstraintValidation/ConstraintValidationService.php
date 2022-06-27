<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\ConstraintValidationStrategyException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\InputDataCollectionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy\ConstraintValidationStrategyInterface;

/**
 * Class ConstraintValidationService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation
 */
class ConstraintValidationService implements ConstraintValidationServiceInterface
{
    /**
     * @var array|ConstraintValidationStrategyInterface[]
     */
    protected array $constraintValidationStrategy;

    /**
     * @param ConstraintValidationContextInterface $constraintValidationContext
     * @param ConstraintValidationStrategyInterface ...$constraintValidationStrategy
     */
    public function __construct(
        protected ConstraintValidationContextInterface $constraintValidationContext,
        ConstraintValidationStrategyInterface ...$constraintValidationStrategy
    ) {
        $this->constraintValidationStrategy = $constraintValidationStrategy;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(mixed $rules, InputDataCollectionInterface $inputData): InputDataCollectionInterface
    {
        $strategy = $this->getStrategy($rules);

        $this->constraintValidationContext->setStrategy($strategy)->execute($rules, $inputData);

        return $inputData;
    }

    /**
     * @param mixed $rules
     *
     * @return ConstraintValidationStrategyInterface
     * @throws ConstraintValidationStrategyException
     */
    protected function getStrategy(mixed $rules): ConstraintValidationStrategyInterface
    {
        foreach ($this->constraintValidationStrategy as $requestValidationStrategy) {
            if ($requestValidationStrategy->isSupport($rules)) {
                return $requestValidationStrategy;
            }
        }

        throw new ConstraintValidationStrategyException('Not found strategy for rules');
    }
}
