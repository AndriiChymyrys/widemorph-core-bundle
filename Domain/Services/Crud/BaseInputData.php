<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;

/**
 * Class BaseInputData
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud
 */
class BaseInputData implements InputDataInterface
{
    /**
     * @param array $input
     */
    public function __construct(protected array $input)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return $this->input;
    }
}
