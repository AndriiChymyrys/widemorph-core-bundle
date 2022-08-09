<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input;

use Symfony\Component\Form\FormInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Bridge\Doctrine\CollectionInterfaceBridge;

/**
 * Class InputDataCollectionInterface
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Contracts
 */
interface InputDataCollectionInterface extends CollectionInterfaceBridge
{
    /**
     * @return FormInterface|null
     */
    public function getForm(): ?FormInterface;

    /**
     * @param FormInterface|null $form
     *
     * @return $this
     */
    public function setForm(?FormInterface $form): self;

    /**
     * @return bool
     */
    public function hasForm(): bool;
}
