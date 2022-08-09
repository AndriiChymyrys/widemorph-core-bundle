<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input;

use Symfony\Component\Form\FormInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Interaction\Bridge\Doctrine\ArrayCollectionBridge;

/**
 * Class InputDataCollection
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\Input
 */
class InputDataCollection extends ArrayCollectionBridge implements InputDataCollectionInterface
{
    /**
     * @var FormInterface|null
     */
    protected ?FormInterface $form = null;

    /**
     * {@inheritDoc}
     */
    public function getForm(): ?FormInterface
    {
        return $this->form;
    }

    /**
     * {@inheritDoc}
     */
    public function setForm(?FormInterface $form): self
    {
        $this->form = $form;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasForm(): bool
    {
        return null !== $this->form;
    }
}
