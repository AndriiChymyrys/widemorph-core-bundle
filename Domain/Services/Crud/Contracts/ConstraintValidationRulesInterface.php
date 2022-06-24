<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class ConstraintValidationRulesInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts
 */
interface ConstraintValidationRulesInterface
{
    /**
     * @return Collection
     */
    public function getConstraints(): Collection;

    /**
     * @return array
     */
    public function getValidationGroups(): array;

    /**
     * @param ConstraintViolationList $constraintViolationList
     *
     * @return void
     */
    public function setViolationList(ConstraintViolationList $constraintViolationList): void;
}
