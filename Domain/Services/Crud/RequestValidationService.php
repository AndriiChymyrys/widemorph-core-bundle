<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\InputDataInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\RequestValidationStrategyException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\RequestValidationContextInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\RequestValidation\Strategy\RequestValidationStrategyInterface;

class RequestValidationService implements RequestValidationServiceInterface
{
    /**
     * @var Request|null
     */
    protected ?Request $request;

    /**
     * @var RequestValidationContextInterface
     */
    protected RequestValidationContextInterface $requestValidationContext;

    /**
     * @var array|RequestValidationStrategyInterface[]
     */
    protected array $requestValidationStrategies;

    /**
     * @param RequestStack $requestStack
     * @param RequestValidationContextInterface $requestValidationContext
     * @param RequestValidationStrategyInterface ...$requestValidationStrategy
     */
    public function __construct(
        RequestStack $requestStack,
        RequestValidationContextInterface $requestValidationContext,
        RequestValidationStrategyInterface ...$requestValidationStrategy
    ) {
        $this->request = $requestStack->getMainRequest();
        $this->requestValidationStrategies = $requestValidationStrategy;
        $this->requestValidationContext = $requestValidationContext;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(mixed $rules, string $inputDataClass = BaseInputData::class): InputDataInterface
    {
        $strategy = $this->getStrategy($rules);

        $inputData = $this->getInputData($inputDataClass);

        $this->requestValidationContext->setStrategy($strategy)->execute($rules, $inputData);

        return $inputData;
    }

    /**
     * @param mixed $rules
     *
     * @return RequestValidationStrategyInterface
     * @throws RequestValidationStrategyException
     */
    protected function getStrategy(mixed $rules): RequestValidationStrategyInterface
    {
        foreach ($this->requestValidationStrategies as $requestValidationStrategy) {
            if ($requestValidationStrategy->isSupport($rules)) {
                return $requestValidationStrategy;
            }
        }

        throw new RequestValidationStrategyException('Not found strategy for rules');
    }

    /**
     * @param string $inputDataClass
     *
     * @return InputDataInterface
     *
     * @throws \JsonException
     */
    protected function getInputData(string $inputDataClass): InputDataInterface
    {
        return new $inputDataClass($this->prepareInputData());
    }

    /**
     * @return array
     *
     * @throws \JsonException
     */
    protected function prepareInputData(): array
    {
        $input = $this->request->request->all();
        $input += $this->request->query->all();

        if ('' !== $content = $this->request->getContent()) {
            $json = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

            $input += $json;
        }

        return $input;
    }
}
