<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy;

/**
 * Class RequestValidationStrategyInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy
 */
interface RequestValidationStrategyInterface
{
    /**
     * @param mixed $rules
     *
     * @return bool
     */
    public function isSupport(mixed $rules): bool;
}
