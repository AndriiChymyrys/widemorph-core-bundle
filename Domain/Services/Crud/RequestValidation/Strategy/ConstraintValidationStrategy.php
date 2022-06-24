<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\ConstraintValidationRulesInterface;

/**
 * Class ConstraintValidationStrategy
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy
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
    public function execute(ConstraintValidationRulesInterface $rules, InputDataInterface $inputData): void
    {
        $validationGroups = $this->getValidationGroup($rules);

        $violations = $this->validator->validate($inputData->all(), $rules->getConstraints(), $validationGroups);

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
