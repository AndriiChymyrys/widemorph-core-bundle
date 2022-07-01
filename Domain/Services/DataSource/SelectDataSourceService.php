<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\ConstraintValidationServiceInterface;

class SelectDataSourceService implements SelectDataSourceServiceInterface
{
    public function __construct(
        protected DataSourceRegistryInterface $dataSourceRegistry,
        protected InputDataFactoryInterface $inputDataFactory,
        protected ConstraintValidationServiceInterface $constraintValidationService
    ) {
    }

    public function execute(string $sourceName)
    {
        $source = $this->dataSourceRegistry->get(DataSourceRegistryInterface::SELECT_DATA_SOURCE_NAME, $sourceName);

        if ($constraint = $source->getConstraint()) {
            $inputData = $this->constraintValidationService->validate($constraint, $this->inputDataFactory->fromRequest());

            if ($constraint->getViolationList()->count()) {

            }
        }

//        var_dump($constraint);
    }
}
