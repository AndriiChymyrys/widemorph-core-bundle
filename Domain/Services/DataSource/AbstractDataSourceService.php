<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataSource;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
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
     * @var Request|null
     */
    protected ?Request $request;

    /**
     * @param DataSourceRegistryInterface $dataSourceRegistry
     * @param InputDataFactoryInterface $inputDataFactory
     * @param ConstraintValidationServiceInterface $constraintValidationService
     * @param OutputDataFactoryInterface $outputDataFactory
     * @param FormFactoryInterface $formFactory
     * @param RequestStack $requestStack
     */
    public function __construct(
        protected DataSourceRegistryInterface $dataSourceRegistry,
        protected InputDataFactoryInterface $inputDataFactory,
        protected ConstraintValidationServiceInterface $constraintValidationService,
        protected OutputDataFactoryInterface $outputDataFactory,
        protected FormFactoryInterface $formFactory,
        RequestStack $requestStack
    ) {
        $this->request = $requestStack->getMainRequest();
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
    protected function dataProcessing(
        DataSourceDefinitionInterface $dataSourceDefinition,
        InputDataCollectionInterface $inputData,
        OutputDataInterface $outputData,
    ): void {
        if ($dataSourceDefinition instanceof ConstraintDataSourceDefinitionInterface) {
            $this->processConstraintValidation($dataSourceDefinition, $inputData, $outputData);
        }

        if ($dataSourceDefinition instanceof FormDataSourceDefinitionInterface) {
            $this->processForm($inputData, $outputData);
        }
    }

    /**
     * @param DataSourceDefinitionInterface $dataSourceDefinition
     * @param InputDataCollectionInterface $inputData
     * @param OutputDataInterface $outputData
     *
     * @return void
     */
    protected function processConstraintValidation(
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

    /**
     * @param DataSourceDefinitionInterface $dataSourceDefinition
     * @param InputDataCollectionInterface $inputData
     * @param mixed $initData
     *
     * @return void
     */
    protected function createForm(
        DataSourceDefinitionInterface $dataSourceDefinition,
        InputDataCollectionInterface $inputData,
        mixed $initData = null
    ): void {
        if ($dataSourceDefinition instanceof FormDataSourceDefinitionInterface) {
            $form = $this->formFactory->create(
                $dataSourceDefinition->getForm(),
                $initData,
                $dataSourceDefinition->getFormOptions()
            );

            $inputData->setForm($form);
        }
    }

    /**
     * @param InputDataCollectionInterface $inputData
     * @param OutputDataInterface $outputData
     *
     * @return void
     */
    protected function processForm(InputDataCollectionInterface $inputData, OutputDataInterface $outputData): void
    {
        if ($inputData->hasForm() && $form = $inputData->getForm()) {
            $name = $form->getName();
            $formData = $inputData->get($name);

            if (!$formData && $this->request->getMethod() === 'GET') {
                // Do not submit form when GET method if there is no data with form name
                return;
            }

            $form->submit($formData ?? $inputData->toArray());

            if (!$form->isValid()) {
                $outputData->setErrors($form->getErrors(true));
            }
        }
    }

    /**
     * @param array|null $input
     *
     * @return array
     */
    protected function initInputOutput(?array $input = null): array
    {
        $outputData = $this->outputDataFactory->createOutputData();
        $inputData = $input ? $this->inputDataFactory->fromArray($input) : $this->inputDataFactory->fromRequest();

        $outputData->setInputData($inputData);

        return [$inputData, $outputData];
    }
}
