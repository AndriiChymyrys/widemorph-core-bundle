<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Contract\DataSource\CreateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

/**
 * Class CreateDataSourceService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
class CreateDataSourceService extends AbstractDataSourceService implements CreateDataSourceServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function execute(string $sourceName, ?array $input = null): OutputDataInterface
    {
        /** @var CreateDataSourceDefinitionInterface $createSource */
        $createSource = $this->dataSourceRegistry->get(
            DataSourceRegistryInterface::CREATE_DATA_SOURCE_NAME,
            $sourceName
        );

        [$inputData, $outputData] = $this->initInputOutput($input);
        $source = $createSource->getSource();
        $sourceData = [];

        $this->createForm($createSource, $inputData);

        if (!$inputData->isEmpty()) {
            $outputData->setIsSubmitted(true);
            $this->dataProcessing($createSource, $inputData, $outputData);

            if ($outputData->hasErrors()) {
                return $outputData;
            }

            $sourceData = $source->create($inputData);
        }

        return $outputData->setSourceData($sourceData);
    }
}
