<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Output\OutputDataFactoryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input\InputDataCollectionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\FormDataSourceDefinitionInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource\Registry\DataSourceRegistryInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\ConstraintDataSourceDefinitionInterface;
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
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        protected DataSourceRegistryInterface $dataSourceRegistry,
        protected InputDataFactoryInterface $inputDataFactory,
        protected ConstraintValidationServiceInterface $constraintValidationService,
        protected OutputDataFactoryInterface $outputDataFactory,
        protected FormFactoryInterface $formFactory,
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

    /**
     * @param DataSourceDefinitionInterface $dataSourceDefinition
     * @param InputDataCollectionInterface $inputData
     * @param OutputDataInterface $outputData
     *
     * @return void
     */
    protected function processValidation(
        DataSourceDefinitionInterface $dataSourceDefinition,
        InputDataCollectionInterface $inputData,
        OutputDataInterface $outputData
    ): void {
        if ($dataSourceDefinition instanceof ConstraintDataSourceDefinitionInterface) {
            $constraint = $dataSourceDefinition->getConstraint();
            $this->constraintValidationService->validate($constraint, $inputData);

            if ($constraint->getViolationList()->count()) {
                $outputData->setErrors($this->violationListToArray($constraint->getViolationList()));
            }
        }
    }

    protected function processForm(
        DataSourceDefinitionInterface $dataSourceDefinition,
        InputDataCollectionInterface $inputData,
        OutputDataInterface $outputData
    ) {
        if ($dataSourceDefinition instanceof FormDataSourceDefinitionInterface) {
            $form = $this->formFactory->create(
                $dataSourceDefinition->getForm(),
                $inputData->toArray(),
                $dataSourceDefinition->getFormOptions()
            );
        }
    }
}
