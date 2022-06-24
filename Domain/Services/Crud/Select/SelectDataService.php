<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Select;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts\{FilterDataRepositoryInterface,
    ResponseDataInterface
};

class SelectDataService implements SelectDataServiceInterface
{
    public function select(
        FilterDataRepositoryInterface $filterDataRepository,
    ): ResponseDataInterface {
        return $filterDataRepository->getList();
    }

    protected function getData(): array
    {

    }
}
