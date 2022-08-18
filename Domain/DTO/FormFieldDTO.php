<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\DTO;

/**
 * Class FormFieldDTO
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\DTO
 */
class FormFieldDTO
{
    /**
     * @param string $field
     * @param string|null $type
     * @param int $priority
     * @param array $options
     */
    public function __construct(
        protected string $field,
        protected ?string $type = null,
        protected int $priority = 1,
        protected array $options = []
    ) {
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }
}
