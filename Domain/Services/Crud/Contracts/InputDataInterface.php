<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts;

/**
 * Class InputDataInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts
 */
interface InputDataInterface
{
    /**
     * @return array
     */
    public function all(): array;
}
