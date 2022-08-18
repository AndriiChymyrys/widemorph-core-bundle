<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\DTO\FormFieldDTO;
use WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Event\FormBuilderFieldsEvent;

/**
 * Class FormFieldService
 *
 * @package WideMorph\Morph\Bundle\MorphCoreBundle\Domain\Services\FormBuilder
 */
class FormFieldService implements FormFieldServiceInterface
{
    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(protected EventDispatcherInterface $eventDispatcher)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function handleFields(array $fields, string $formName): array
    {
        $event = $this->dispatchEvent($fields, $formName);

        if ($event->hasChanges()) {
            $fields = $this->handleEventFields($event);
        }

        $this->sort($fields);

        return $fields;
    }

    /**
     * @param array $fields
     *
     * @return void
     */
    protected function sort(array &$fields): void
    {
        uasort($fields, static function (FormFieldDTO $a, FormFieldDTO $b) {
            if ($a->getPriority() === $b->getPriority()) {
                return 0;
            }

            return ($a->getPriority() < $b->getPriority()) ? -1 : 1;
        });
    }

    /**
     * @param array $fields
     * @param string $formName
     *
     * @return FormBuilderFieldsEvent
     */
    protected function dispatchEvent(array $fields, string $formName): FormBuilderFieldsEvent
    {
        $eventName = sprintf('%s.%s', FormBuilderFieldsEvent::NAME, $formName);
        $event = new FormBuilderFieldsEvent($fields);

        $this->eventDispatcher->dispatch($event, $eventName);

        return $event;
    }

    /**
     * @param FormBuilderFieldsEvent $event
     *
     * @return array
     */
    protected function handleEventFields(FormBuilderFieldsEvent $event): array
    {
        $fields = $event->getFields();

        if ($newFields = $event->getNewFields()) {
            foreach ($newFields as $name => $filed) {
                $fields[$name] = $filed;
            }
        }

        return array_filter($fields, static fn($item) => $item !== null);
    }
}
