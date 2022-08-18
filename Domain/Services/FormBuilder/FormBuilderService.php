<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder;

use Symfony\Component\Form\FormBuilderInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\DTO\FormFieldDTO;

/**
 * Class FormBuilderService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder
 */
class FormBuilderService implements FormBuilderServiceInterface
{
    /**
     * @var FormFieldDTO[]
     */
    protected array $fields = [];

    /**
     * @param FormFieldServiceInterface $formFieldService
     */
    public function __construct(protected FormFieldServiceInterface $formFieldService)
    {
    }

    /**
     * @param string $field
     * @param string|null $type
     * @param int $priority
     * @param array $options
     *
     * @return $this
     */
    public function add(string $field, string $type = null, int $priority = 1, array $options = []): self
    {
        $this->fields[$field] = new FormFieldDTO($field, $type, $priority, $options);

        return $this;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param string $formName
     *
     * @return FormBuilderInterface
     */
    public function build(FormBuilderInterface $builder, string $formName): FormBuilderInterface
    {
        $fields = $this->formFieldService->handleFields($this->fields, $formName);

        foreach ($fields as $field) {
            $builder->add($field->getField(), $field->getType(), $field->getOptions());
        }

        return $builder;
    }

    /**
     * @return $this
     */
    public function resetFields(): self
    {
        $this->fields = [];

        return $this;
    }
}
