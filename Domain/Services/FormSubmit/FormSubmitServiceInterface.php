<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormSubmit;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormErrorIterator;

/**
 * Class FormSubmitServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormSubmit
 */
interface FormSubmitServiceInterface
{
    /**
     * @param string $formType
     * @param array|null $submitData
     *
     * @return FormInterface
     */
    public function submitForm(string $formType, array $submitData = null): FormInterface;

    /**
     * @return FormInterface
     */
    public function getForm(): FormInterface;

    /**
     * @param FormErrorIterator|null $formErrors
     *
     * @return array
     */
    public function getFormErrors(?FormErrorIterator $formErrors = null): array;
}
