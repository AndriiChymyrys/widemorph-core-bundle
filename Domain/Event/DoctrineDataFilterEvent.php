<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event;

use Symfony\Contracts\EventDispatcher\Event;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterResultInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterStrategyInterface;

/**
 * Class DoctrineDataFilterEvent
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event
 */
class DoctrineDataFilterEvent extends Event
{
    /** @var string */
    public const NAME = 'doctrine.data.filter';

    /** @var array */
    protected array $removeFilters = [];

    /** @var array */
    protected array $addFilters = [];

    /**
     * @var DoctrineDataFilterResultInterface|null
     */
    protected ?DoctrineDataFilterResultInterface $doctrineDataFilterResult = null;

    /**
     * @return DoctrineDataFilterResultInterface|null
     */
    public function getDoctrineDataFilterResult(): ?DoctrineDataFilterResultInterface
    {
        return $this->doctrineDataFilterResult;
    }

    /**
     * @param DoctrineDataFilterResultInterface $doctrineDataFilterResult
     */
    public function setDoctrineDataFilterResult(DoctrineDataFilterResultInterface $doctrineDataFilterResult): void
    {
        $this->doctrineDataFilterResult = $doctrineDataFilterResult;
    }

    /**
     * @return array
     */
    public function getRemoveFilters(): array
    {
        return $this->removeFilters;
    }

    /**
     * @param DoctrineDataFilterStrategyInterface $dataFilterStrategy
     *
     * @return void
     */
    public function addRemoveFilter(DoctrineDataFilterStrategyInterface $dataFilterStrategy): void
    {
        $this->removeFilters[] = $dataFilterStrategy;
    }

    /**
     * @return array
     */
    public function getAddFilters(): array
    {
        return $this->addFilters;
    }

    /**
     * @param DoctrineDataFilterStrategyInterface $dataFilterStrategy
     * @param int $priority
     *
     * @return void
     */
    public function addFilters(DoctrineDataFilterStrategyInterface $dataFilterStrategy, int $priority): void
    {
        $this->addFilters[] = [$dataFilterStrategy, $priority];
    }
}
