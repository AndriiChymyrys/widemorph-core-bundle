<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Crud\Contracts;

interface FilterDataRepositoryInterface
{
    public function getList(InputDataInterface $data): ResponseDataInterface;
}
