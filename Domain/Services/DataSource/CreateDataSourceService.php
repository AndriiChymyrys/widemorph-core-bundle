<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\CreateDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

class CreateDataSourceService extends AbstractDataSourceService implements CreateDataSourceServiceInterface
{
    public function execute(string $sourceName, ?array $input = null): OutputDataInterface
    {
        /** @var CreateDataSourceDefinitionInterface $selectSource */
        $selectSource = $this->dataSourceRegistry->get(
            DataSourceRegistryInterface::CREATE_DATA_SOURCE_NAME,
            $sourceName
        );

        $outputData = $this->outputDataFactory->createOutputData();
        $inputData = $input ? $this->inputDataFactory->fromArray($input) : $this->inputDataFactory->fromRequest();

        $this->processValidation($selectSource, $inputData, $outputData);

        if ($outputData->hasErrors()) {
            return $outputData;
        }

        $source = $selectSource->getSource();

        $data = $inputData->isEmpty() ? [] : $source->create($inputData);

        return $outputData->setSourceData($data);
    }
}
