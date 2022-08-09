<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output;

use Symfony\Component\Form\FormErrorIterator;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class OutputData
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output
 */
class OutputData implements OutputDataInterface
{
    /**
     * @var null|array|FormErrorIterator
     */
    protected null|array|FormErrorIterator $errors = null;

    /**
     * @var mixed|null
     */
    protected mixed $sourceData = null;

    /**
     * @var InputDataCollectionInterface
     */
    protected InputDataCollectionInterface $inputDataCollection;

    /**
     * {@inheritDoc}
     */
    public function setErrors(FormErrorIterator|array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getErrors(): array|FormErrorIterator
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
        return null !== $this->errors;
    }

    /**
     * {@inheritDoc}
     */
    public function getInputData(): InputDataCollectionInterface
    {
        return $this->inputDataCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function setInputData(InputDataCollectionInterface $inputDataCollection): self
    {
        $this->inputDataCollection = $inputDataCollection;

        return $this;
    }
}
