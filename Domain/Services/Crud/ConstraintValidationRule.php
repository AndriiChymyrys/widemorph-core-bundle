<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud;

use Symfony\Component\Validator\ConstraintViolationList;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\ConstraintValidationRulesInterface;

/**
 * Class ConstraintValidationRule
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud
 */
abstract class ConstraintValidationRule implements ConstraintValidationRulesInterface
{
    /**
     * @var ConstraintViolationList
     */
    protected ConstraintViolationList $constraintViolationList;

    /**
     * {@inheritDoc}
     */
    public function getValidationGroups(): array
    {
        return ['Default'];
    }

    /**
     * {@inheritDoc}
     */
    public function setViolationList(ConstraintViolationList $constraintViolationList): void
    {
        $this->constraintViolationList = $constraintViolationList;
    }
}
