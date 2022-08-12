<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DeleteDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

/**
 * Class DeleteDataSourceService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
class DeleteDataSourceService extends AbstractDataSourceService implements DeleteDataSourceServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function execute(string $sourceName, ?array $options = null): OutputDataInterface
    {
        /** @var DeleteDataSourceDefinitionInterface $deleteSource */
        $deleteSource = $this->dataSourceRegistry->get(
            DataSourceRegistryInterface::DELETE_DATA_SOURCE_NAME,
            $sourceName
        );

        [$inputData, $outputData] = $this->initInputOutput();

        $this->dataProcessing($deleteSource, $inputData, $outputData);

        if ($outputData->hasErrors()) {
            return $outputData;
        }

        $source = $deleteSource->getSource();
        $deleteItem = $deleteSource->getDeleteItem($options);

        return $outputData->setSourceData($source->delete($inputData, $deleteItem));
    }
}
