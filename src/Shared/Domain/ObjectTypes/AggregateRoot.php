<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shared\Domain\ObjectTypes;

use Profitcatd\Recruitment\Shared\Domain\Identity\Identifier;

abstract class AggregateRoot
{
    /**
     * @var Event[]
     */
    protected array $events = [];

    abstract public function id(): Identifier;

    /**
     * @return Event[]
     */
    final public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function raise(Event $event): void
    {
        $this->events[] = $event;
    }
}
