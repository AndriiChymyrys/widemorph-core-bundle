<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\SelectDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

/**
 * Class SelectDataSourceService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
class SelectDataSourceService extends AbstractDataSourceService implements SelectDataSourceServiceInterface
{
    /**
     * {@inheritDoc}
     */
    public function execute(string $sourceName, ?array $input = null): OutputDataInterface
    {
        /** @var SelectDataSourceDefinitionInterface $selectSource */
        $selectSource = $this->dataSourceRegistry->get(DataSourceRegistryInterface::SELECT_DATA_SOURCE_NAME, $sourceName);
        $outputData = $this->outputDataFactory->createOutputData();
        $inputData = $input ? $this->inputDataFactory->fromArray($input) : $this->inputDataFactory->fromRequest();

        $this->processValidation($selectSource, $inputData, $outputData);

        if ($outputData->hasErrors()) {
            return $outputData;
        }

        $source = $selectSource->getSource();
        $pagination = $selectSource->getSourcePagination($inputData);

        return $outputData->setSourceData($source->select($inputData, $pagination));
    }
}
