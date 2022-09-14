<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormSubmit;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataFactoryInterface;

/**
 * Class FormSubmitService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormSubmit
 */
class FormSubmitService implements FormSubmitServiceInterface
{
    /**
     * @var FormInterface
     */
    protected FormInterface $form;

    /**
     * @param InputDataFactoryInterface $inputDataFactory
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        protected readonly InputDataFactoryInterface $inputDataFactory,
        protected readonly FormFactoryInterface $formFactory
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function submitForm(string $formType, array $submitData = null): FormInterface
    {
        $data = $submitData ? $this->inputDataFactory->fromArray($submitData) : $this->inputDataFactory->fromRequest();

        $this->form = $this->formFactory->create($formType)->submit($data->toArray());

        return $this->form;
    }

    /**
     * {@inheritDoc}
     */
    public function getForm(): FormInterface
    {
        return $this->form;
    }

    /**
     * {@inheritDoc}
     */
    public function getFormErrors(?FormErrorIterator $formErrors = null): array
    {
        $errors = $formErrors ?? $this->form->getErrors(true, false);

        $arrayErrors = [];

        foreach ($errors as $error) {
            if ($error instanceof FormErrorIterator) {
                $arrayErrors[$error->getForm()->getName()] = $this->getFormErrors($error);
            } else {
                $arrayErrors[] = $error->getMessage();
            }
        }

        return $arrayErrors;
    }
}
