<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output;

/**
 * Class OutputDataInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output
 */
interface OutputDataInterface
{
    /**
     * @param array $errors
     *
     * @return $this
     */
    public function setErrors(array $errors): self;

    /**
     * @return array
     */
    public function getErrors(): array;

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
}
