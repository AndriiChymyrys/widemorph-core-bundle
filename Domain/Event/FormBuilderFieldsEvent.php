<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event;

use Symfony\Contracts\EventDispatcher\Event;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\DTO\FormFieldDTO;

/**
 * Class FormBuilderFieldsEvent
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event
 */
class FormBuilderFieldsEvent extends Event
{
    /** @var string */
    public const NAME = 'morph.form.field.builder';

    /** @var array */
    protected array $newFields;

    /** @var bool */
    protected bool $hasChanges = false;

    /**
     * @param array $fields
     */
    public function __construct(protected array $fields)
    {
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->hasChanges = true;

        $this->fields = $fields;
    }

    /**
     * @param string $field
     * @param string|null $type
     * @param int $priority
     * @param array $options
     *
     * @return void
     */
    public function addNewField(string $field, string $type = null, int $priority = 1, array $options = []): void
    {
        $this->hasChanges = true;

        $this->newFields[$field] = new FormFieldDTO($field, $type, $priority, $options);
    }

    /**
     * @param string $field
     *
     * @return void
     */
    public function removeField(string $field): void
    {
        $this->hasChanges = true;

        $this->newFields[$field] = null;
    }

    /**
     * @return array
     */
    public function getNewFields(): array
    {
        return $this->newFields;
    }

    /**
     * @return bool
     */
    public function hasChanges(): bool
    {
        return $this->hasChanges;
    }
}
