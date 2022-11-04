<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource;

/**
 * Class CreateDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource
 */
interface CreateDataSourceDefinitionInterface extends DataSourceDefinitionInterface
{
    /** @var string */
    public const SERVICE_TAG_NAME = 'create.data.source';

    /**
     * @return CreateDataSourceInterface
     */
    public function getSource(): CreateDataSourceInterface;
}
