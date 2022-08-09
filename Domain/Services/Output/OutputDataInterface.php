<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output;

use Symfony\Component\Form\FormErrorIterator;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;

/**
 * Class OutputDataInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output
 */
interface OutputDataInterface
{
    /**
     * @param array|FormErrorIterator $errors
     *
     * @return $this
     */
    public function setErrors(FormErrorIterator|array $errors): self;

    /**
     * @return array|FormErrorIterator
     */
    public function getErrors(): array|FormErrorIterator;

    /**
     * @return mixed
     */
    public function getSourceData(): mixed;

    /**
     * @param mixed $sourceData
     *
     * @return $this
     */
    public function setSourceData(mixed $sourceData): self;

    /**
     * @return bool
     */
    public function hasErrors(): bool;

    /**
     * @return InputDataCollectionInterface
     */
    public function getInputData(): InputDataCollectionInterface;

    /**
     * @param InputDataCollectionInterface $inputDataCollection
     *
     * @return $this
     */
    public function setInputData(InputDataCollectionInterface $inputDataCollection): self;
}
