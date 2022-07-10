<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class InputDataFactory implements InputDataFactoryInterface
{
    /**
     * @var Request|null
     */
    protected ?Request $request;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getMainRequest();
    }

    /**
     * {@inheritDoc}
     */
    public function fromRequest(): InputDataCollectionInterface
    {
        $data = $this->prepareInputData();

        return new InputDataCollection($data);
    }

    /**
     * {@inheritDoc}
     */
    public function fromArray(array $data): InputDataCollectionInterface
    {
        return new InputDataCollection($data);
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
