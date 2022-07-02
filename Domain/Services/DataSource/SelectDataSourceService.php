<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;

/**
 * Class SelectDataSourceService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
class SelectDataSourceService extends AbstractDataSourceService implements SelectDataSourceServiceInterface
{
    /**
     * @param string $sourceName
     *
     * @return OutputDataInterface
     */
    public function execute(string $sourceName): OutputDataInterface
    {
        $selectSource = $this->dataSourceRegistry->get(DataSourceRegistryInterface::SELECT_DATA_SOURCE_NAME, $sourceName);
        $outputData = $this->outputDataFactory->createOutputData();
        $inputData = $this->inputDataFactory->fromRequest();

        if ($constraint = $selectSource->getConstraint()) {
            $this->constraintValidationService->validate($constraint, $inputData);

            if ($constraint->getViolationList()->count()) {
                return $outputData->setErrors($this->violationListToArray($constraint->getViolationList()));
            }
        }

        $source = $selectSource->getSource();

        return $outputData->setSourceData($source->select($inputData));
    }
}
