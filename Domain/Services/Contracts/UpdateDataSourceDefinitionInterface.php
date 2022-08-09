<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

/**
 * Class UpdateDataSourceDefinitionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface UpdateDataSourceDefinitionInterface extends DataSourceDefinitionInterface
{
    /** @var string */
    public const SERVICE_TAG_NAME = 'update.data.source';

    /**
     * @return UpdateDataSourceInterface
     */
    public function getSource(): UpdateDataSourceInterface;

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getUpdateItem(array $data): mixed;
}
