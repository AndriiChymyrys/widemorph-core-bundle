<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine;

use Doctrine\ORM\Query;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterResultInterface;

/**
 * Class DoctrineDataFilterContextFactory
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine
 */
class DoctrineDataFilterContextFactory implements DoctrineDataFilterContextFactoryInterface
{
    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @param EntityManagerInterface $entityManager
     * @param DoctrineDataFilterResultInterface $doctrineDataFilterResult
     */
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
        protected EntityManagerInterface $entityManager,
        protected DoctrineDataFilterResultInterface $doctrineDataFilterResult
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function forQueryBuilder(
        ?QueryBuilder $queryBuilder = null,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface {
        $queryBuilder = $this->createQueryBuilder($queryBuilder);

        return $this->create($queryBuilder, $name, $dispatchEvent);
    }

    /**
     * {@inheritDoc}
     */
    public function forNativeQuery(
        NativeQuery|string $nativeQuery,
        ResultSetMapping $rsm,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface {
        $nativeQuery = $this->createNativeBuilder($nativeQuery, $rsm);

        return $this->create($nativeQuery, $name, $dispatchEvent);
    }

    /**
     * {@inheritDoc}
     */
    public function forQuery(
        Query|string $query,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface {
        $query = $this->createQuery($query);

        return $this->create($query, $name, $dispatchEvent);
    }

    /**
     * @param QueryBuilder|NativeQuery|Query $query
     * @param string|null $name
     * @param bool|null $dispatchEvent
     *
     * @return DoctrineDataFilterContextInterface
     */
    protected function create(
        QueryBuilder|NativeQuery|Query $query,
        ?string $name = null,
        ?bool $dispatchEvent = false
    ): DoctrineDataFilterContextInterface {
        return (new DoctrineDataFilterContext($this->eventDispatcher, $query, $name, $dispatchEvent))
            ->setDoctrineDataFilterResult($this->doctrineDataFilterResult);
    }

    /**
     * @param QueryBuilder|null $queryBuilder
     *
     * @return QueryBuilder
     */
    protected function createQueryBuilder(?QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?: $this->entityManager->createQueryBuilder();
    }

    /**
     * @param NativeQuery|string $nativeQuery
     * @param ResultSetMapping $rsm
     *
     * @return NativeQuery
     */
    protected function createNativeBuilder(
        NativeQuery|string $nativeQuery,
        ResultSetMapping $rsm,
    ): NativeQuery {
        if (is_string($nativeQuery)) {
            return $this->entityManager->createNativeQuery($nativeQuery, $rsm);
        }

        return $nativeQuery;
    }

    /**
     * @param Query|string $query
     *
     * @return Query
     */
    protected function createQuery(Query|string $query): Query
    {
        return is_string($query) ? $this->entityManager->createQuery($query) : $query;
    }
}
