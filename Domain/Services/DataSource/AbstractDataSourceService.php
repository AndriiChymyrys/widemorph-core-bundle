<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use Symfony\Component\Validator\ConstraintViolationList;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\ConstraintValidation\ConstraintValidationServiceInterface;

/**
 * Class AbstractDataSourceService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource
 */
class AbstractDataSourceService
{
    /**
     * @param DataSourceRegistryInterface $dataSourceRegistry
     * @param InputDataFactoryInterface $inputDataFactory
     * @param ConstraintValidationServiceInterface $constraintValidationService
     * @param OutputDataFactoryInterface $outputDataFactory
     */
    public function __construct(
        protected DataSourceRegistryInterface $dataSourceRegistry,
        protected InputDataFactoryInterface $inputDataFactory,
        protected ConstraintValidationServiceInterface $constraintValidationService,
        protected OutputDataFactoryInterface $outputDataFactory
    ) {
    }

    /**
     * @param ConstraintViolationList $constraintViolationList
     *
     * @return array
     */
    protected function violationListToArray(ConstraintViolationList $constraintViolationList): array
    {
        $violations = [];

        foreach ($constraintViolationList as $violation) {
            $violations[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return $violations;
    }
}
