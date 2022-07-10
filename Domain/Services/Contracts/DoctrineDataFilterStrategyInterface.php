<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

use Doctrine\ORM\QueryBuilder;

/**
 * Class DoctrineQueryBuilderDataFilterStrategyInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface DoctrineDataFilterStrategyInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     *
     * @return void
     */
    public function execute(QueryBuilder $queryBuilder): void;
}
