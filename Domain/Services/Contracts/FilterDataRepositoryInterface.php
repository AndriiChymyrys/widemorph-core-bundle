<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

/**
 * Class FilterDataRepositoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface FilterDataRepositoryInterface
{
    public function getList(InputDataInterface $data): ResponseDataInterface;
}
