<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource;

/**
 * Class DeleteDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource
 */
interface DeleteDataSourceDefinitionInterface extends DataSourceDefinitionInterface
{
    /** @var string */
    public const SERVICE_TAG_NAME = 'delete.data.source';

    /**
     * @return DeleteDataSourceInterface
     */
    public function getSource(): DeleteDataSourceInterface;

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getDeleteItem(array $data): mixed;
}
