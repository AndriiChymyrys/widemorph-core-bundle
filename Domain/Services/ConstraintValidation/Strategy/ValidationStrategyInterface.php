<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy;

/**
 * Class RequestValidationStrategyInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\Strategy
 */
interface ValidationStrategyInterface
{
    /**
     * @param mixed $rules
     *
     * @return bool
     */
    public function isSupport(mixed $rules): bool;
}
