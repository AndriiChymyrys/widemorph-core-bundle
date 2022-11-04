<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\DataSourceException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource\UpdateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

/**
 * Class UpdateDataSourceService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
class UpdateDataSourceService extends AbstractDataSourceService implements UpdateDataSourceServiceInterface
{
    /**
     * {@inheritDoc}
     *
     * @throws DataSourceException
     */
    public function execute(string $sourceName, ?array $input = null, ?array $options = []): OutputDataInterface
    {
        /** @var UpdateDataSourceDefinitionInterface $updateSource */
        $updateSource = $this->dataSourceRegistry->get(
            DataSourceRegistryInterface::UPDATE_DATA_SOURCE_NAME,
            $sourceName
        );

        [$inputData, $outputData] = $this->initInputOutput($input);
        $source = $updateSource->getSource();
        $initData = $updateSource->getUpdateItem($options);
        $sourceData = [];

        if (empty($initData)) {
            throw new DataSourceException(
                'Update item should not be empty for update source, try to implement getUpdateItem() method'
            );
        }

        $this->createForm($updateSource, $inputData, $initData);

        if (!$inputData->isEmpty()) {
            $outputData->setIsSubmitted(true);
            $this->dataProcessing($updateSource, $inputData, $outputData);

            if ($outputData->hasErrors()) {
                return $outputData;
            }

            $sourceData = $source->update($inputData, $initData);
        }

        return $outputData->setSourceData($sourceData);
    }
}
