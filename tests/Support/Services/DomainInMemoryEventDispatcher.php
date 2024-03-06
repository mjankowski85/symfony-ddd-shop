<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\Support\Services;

use Profitcatd\Recruitment\Shared\Domain\ObjectTypes\Event;
use Profitcatd\Recruitment\Shared\Application\Services\DomainEventDispatcher;

final class DomainInMemoryEventDispatcher implements DomainEventDispatcher
{
    /**
     * @var Event[]
     */
    private array $dispatchedEvents = [];

    public function dispatch(Event ...$events): void
    {
        foreach ($events as $event) {
            $this->dispatchedEvents[] = $event;
        }
    }

    public function eventHasBeenDispatched(string $name, string $aggregateRootId): bool
    {
        foreach ($this->dispatchedEvents as $event) {
            if ($event->eventName() === $name && $event->aggregateId()->value === $aggregateRootId) {
                return true;
            }
        }

        return false;
    }

    public function eventHasBeenDispatchedTimes(string $name): int
    {
        $counter = 0;
        foreach ($this->dispatchedEvents as $event) {
            if ($event->eventName() === $name) {
                ++$counter;
            }
        }

        return $counter;
    }
}
