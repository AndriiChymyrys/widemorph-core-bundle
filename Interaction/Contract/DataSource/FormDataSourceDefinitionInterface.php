<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource;

/**
 * Class FormDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource
 */
interface FormDataSourceDefinitionInterface
{
    /**
     * @return string
     */
    public function getForm(): string;

    /**
     * @return array
     */
    public function getFormOptions(): array;
}
