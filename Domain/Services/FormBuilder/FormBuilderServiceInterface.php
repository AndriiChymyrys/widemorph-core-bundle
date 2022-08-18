<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder;

use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FormBuilderServiceInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder
 */
interface FormBuilderServiceInterface
{
    /**
     * @param string $field
     * @param string|null $type
     * @param int $priority
     * @param array $options
     *
     * @return $this
     */
    public function add(string $field, string $type = null, int $priority = 1, array $options = []): self;

    /**
     * @param FormBuilderInterface $builder
     * @param string $formName
     *
     * @return FormBuilderInterface
     */
    public function build(FormBuilderInterface $builder, string $formName): FormBuilderInterface;

    /**
     * @return $this
     */
    public function resetFields(): self;
}
