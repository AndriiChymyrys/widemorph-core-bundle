<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder;

/**
 * Class FormFieldServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder
 */
interface FormFieldServiceInterface
{
    /**
     * @param array $fields
     * @param string $formName
     *
     * @return array
     */
    public function handleFields(array $fields, string $formName): array;
}
