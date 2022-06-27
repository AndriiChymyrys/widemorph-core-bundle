<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\ConstraintValidationRulesInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\InputDataCollectionInterface;

/**
 * Class ConstraintValidationStrategy
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy
 */
class ConstraintValidationStrategy implements ConstraintValidationStrategyInterface
{
    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function isSupport(mixed $rules): bool
    {
        return $rules instanceof ConstraintValidationRulesInterface;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(ConstraintValidationRulesInterface $rules, InputDataCollectionInterface $inputData): void
    {
        $validationGroups = $this->getValidationGroup($rules);

        $violations = $this->validator->validate($inputData->toArray(), $rules->getConstraints(), $validationGroups);

        $rules->setViolationList($violations);
    }

    /**
     * @param ConstraintValidationRulesInterface $rules
     *
     * @return Assert\GroupSequence
     */
    protected function getValidationGroup(ConstraintValidationRulesInterface $rules): Assert\GroupSequence
    {
        return new Assert\GroupSequence($rules->getValidationGroups());
    }
}
