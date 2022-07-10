<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine;

use Doctrine\ORM\Query;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Class DoctrineDataFilterContextFactoryInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine
 */
interface DoctrineDataFilterContextFactoryInterface
{
    /**
     * @param QueryBuilder|null $queryBuilder
     * @param string|null $name
     * @param bool|null $dispatchEvent
     *
     * @return DoctrineDataFilterContextInterface
     */
    public function forQueryBuilder(
        ?QueryBuilder $queryBuilder = null,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface;

    /**
     * @param NativeQuery|string $nativeQuery
     * @param ResultSetMapping $rsm
     * @param string|null $name
     * @param bool|null $dispatchEvent
     *
     * @return DoctrineDataFilterContextInterface
     */
    public function forNativeQuery(
        NativeQuery|string $nativeQuery,
        ResultSetMapping $rsm,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface;

    /**
     * @param Query|string $query
     * @param string|null $name
     * @param bool|null $dispatchEvent
     *
     * @return DoctrineDataFilterContextInterface
     */
    public function forQuery(
        Query|string $query,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface;
}
