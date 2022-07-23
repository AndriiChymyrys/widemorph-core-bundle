<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output;

/**
 * Class OutputData
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output
 */
class OutputData implements OutputDataInterface
{
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @var mixed|null
     */
    protected mixed $sourceData = null;

    /**
     * {@inheritDoc}
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * {@inheritDoc}
     */
    public function getSourceData(): mixed
    {
        return $this->sourceData;
    }

    /**
     * {@inheritDoc}
     */
    public function setSourceData(mixed $sourceData): self
    {
        $this->sourceData = $sourceData;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
