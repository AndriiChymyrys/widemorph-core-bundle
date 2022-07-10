<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine\Result;

use Doctrine\ORM\Query;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterResultInterface;

/**
 * Class DoctrineDataFilterResult
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine
 */
class DoctrineDataFilterResult implements DoctrineDataFilterResultInterface
{
    /**
     * @param PaginatorInterface $paginator
     */
    public function __construct(protected PaginatorInterface $paginator)
    {
    }

    /**
     * @var NativeQuery|Query|QueryBuilder
     */
    protected NativeQuery|Query|QueryBuilder $query;

    /**
     * @var int
     */
    protected int $page = 1;

    /**
     * @var int
     */
    protected int $perPage = 0;

    /**
     * @var bool
     */
    protected bool $paginate = false;

    /**
     * {@inheritDoc}
     */
    public function getResult(): mixed
    {
        if ($this->paginate) {
            return $this->paginator->paginate($this->query, $this->page, $this->perPage);
        }

        return $this->query->getQuery()->getResult();
    }

    /**
     * {@inheritDoc}
     */
    public function getQuery(): NativeQuery|Query|QueryBuilder
    {
        return $this->query;
    }

    /**
     * {@inheritDoc}
     */
    public function setQuery(NativeQuery|Query|QueryBuilder $query): DoctrineDataFilterResultInterface
    {
        $this->query = $query;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setPagination(int $page, int $perPage): self
    {
        $this->paginate = true;
        $this->page = $page;
        $this->perPage = $perPage;

        return $this;
    }
}
