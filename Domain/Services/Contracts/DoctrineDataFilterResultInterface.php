<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts;

use Doctrine\ORM\Query;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\QueryBuilder;

/**
 * Class DoctrineDataFilterResultInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface DoctrineDataFilterResultInterface
{
    /**
     * @return mixed
     */
    public function getResult(): mixed;

    /**
     * @return NativeQuery|Query|QueryBuilder
     */
    public function getQuery(): NativeQuery|Query|QueryBuilder;

    /**
     * @param QueryBuilder|NativeQuery|Query $query
     *
     * @return DoctrineDataFilterResultInterface
     */
    public function setQuery(QueryBuilder|NativeQuery|Query $query): self;

    /**
     * @param int $page
     * @param int $perPage
     *
     * @return $this
     */
    public function setPagination(int $page, int $perPage): self;
}
