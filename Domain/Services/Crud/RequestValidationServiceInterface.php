<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;

/**
 * Class RequestValidationServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud
 */
interface RequestValidationServiceInterface
{
    /**
     * @param mixed $rules
     * @param string $inputDataClass
     *
     * @return InputDataInterface
     */
    public function validate(mixed $rules, string $inputDataClass = BaseInputData::class): InputDataInterface;
}