<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine;

use Doctrine\ORM\Query;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event\DoctrineDataFilterEvent;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Exception\DataFilterContextException;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterResultInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterStrategyInterface;

/**
 * Class DoctrineDataFilterContext
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine
 */
class DoctrineDataFilterContext implements DoctrineDataFilterContextInterface
{
    /**
     * @var null|DoctrineDataFilterStrategyInterface[]
     */
    protected ?array $filters = null;

    /**
     * @var DoctrineDataFilterResultInterface|null
     */
    protected ?DoctrineDataFilterResultInterface $doctrineDataFilterResult = null;

    /**
     * @var DoctrineDataFilterResultInterface|null
     */
    protected ?DoctrineDataFilterResultInterface $eventDoctrineDataFilterResult = null;

    /**
     * @param string|null $contextName
     * @param EventDispatcherInterface $eventDispatcher
     * @param QueryBuilder|NativeQuery|Query $query
     * @param bool $dispatchEvent
     */
    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
        protected QueryBuilder|NativeQuery|Query $query,
        protected ?string $contextName = null,
        protected bool $dispatchEvent = false
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function addFilter(DoctrineDataFilterStrategyInterface $dataFilterStrategy, int $priority = 0): self
    {
        if (isset($this->filters[get_class($dataFilterStrategy)])) {
            return $this;
        }

        $this->filters[get_class($dataFilterStrategy)] = ['filter' => $dataFilterStrategy, 'priority' => $priority];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function removeFilter(DoctrineDataFilterStrategyInterface $dataFilterStrategy): self
    {
        if (isset($this->filters[get_class($dataFilterStrategy)])) {
            unset($this->filters[get_class($dataFilterStrategy)]);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * @throws DataFilterContextException
     */
    public function execute(
        ?DoctrineDataFilterResultInterface $doctrineDataFilterResult = null
    ): DoctrineDataFilterResultInterface {

        if ($this->dispatchEvent && $this->contextName) {
            $this->dispatchEvent();
        }

        if ($this->filters) {
            $this->applyFilters();
        }

        $doctrineDataFilterResult = $this->eventDoctrineDataFilterResult ??
            $doctrineDataFilterResult ??
            $this->doctrineDataFilterResult;

        if (!$doctrineDataFilterResult) {
            throw new DataFilterContextException(
                'Context without DoctrineDataFilterResultInterface can not be executed'
            );
        }

        return $doctrineDataFilterResult->setQuery($this->query);
    }

    /**
     * {@inheritDoc}
     */
    public function setDoctrineDataFilterResult(DoctrineDataFilterResultInterface $doctrineDataFilterResult): self
    {
        $this->doctrineDataFilterResult = $doctrineDataFilterResult;

        return $this;
    }

    /**
     * @return void
     */
    protected function applyFilters(): void
    {
        $this->sortByPriority();

        foreach ($this->filters as $filter) {
            $filter->execute($this->query);
        }
    }

    /**
     * @return void
     */
    protected function sortByPriority(): void
    {
        usort($this->filters, static function ($a, $b) {
            if ($a['priority'] === $b['priority']) {
                return 0;
            }

            return ($a['priority'] > $b['priority']) ? -1 : 1;
        });
    }

    /**
     * @return void
     */
    protected function dispatchEvent(): void
    {
        $eventName = sprintf('%s.%s', DoctrineDataFilterEvent::NAME, $this->contextName);
        $event = new DoctrineDataFilterEvent();

        $this->eventDispatcher->dispatch($event, $eventName);

        if ($addFilters = $event->getAddFilters()) {
            foreach ($addFilters as [$filter, $priority]) {
                $this->addFilter($filter, $priority);
            }
        }

        if ($removeFilters = $event->getRemoveFilters()) {
            foreach ($removeFilters as $removeFilter) {
                $this->removeFilter($removeFilter);
            }
        }

        $this->eventDoctrineDataFilterResult = $event->getDoctrineDataFilterResult();
    }
}
