<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine;

use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterResultInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts\DoctrineDataFilterStrategyInterface;

/**
 * Class DoctrineDataFilterContextInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\DataFilter\Doctrine
 */
interface DoctrineDataFilterContextInterface
{
    /**
     * @param DoctrineDataFilterStrategyInterface $dataFilterStrategy
     * @param int $priority
     *
     * @return $this
     */
    public function addFilter(DoctrineDataFilterStrategyInterface $dataFilterStrategy, int $priority = 0): self;

    /**
     * @param DoctrineDataFilterStrategyInterface $dataFilterStrategy
     *
     * @return $this
     */
    public function removeFilter(DoctrineDataFilterStrategyInterface $dataFilterStrategy): self;

    /**
     * @param DoctrineDataFilterResultInterface|null $doctrineDataFilterResult
     *
     * @return DoctrineDataFilterResultInterface
     */
    public function execute(
        ?DoctrineDataFilterResultInterface $doctrineDataFilterResult = null
    ): DoctrineDataFilterResultInterface;

    /**
     * @param DoctrineDataFilterResultInterface $doctrineDataFilterResult
     *
     * @return $this
     */
    public function setDoctrineDataFilterResult(DoctrineDataFilterResultInterface $doctrineDataFilterResult): self;
}
