<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\Support\Utils;

use Profitcatd\Recruitment\Shared\Domain\ObjectTypes\Event;

trait DomainEventAssertion
{
    public static function assertDomainEvent(Event $expectedEvent, Event $actualEvent): void
    {
        self::assertEquals($expectedEvent->aggregateId(), $actualEvent->aggregateId());
        self::assertEquals($expectedEvent->eventName(), $actualEvent->eventName());
        self::assertEquals($expectedEvent->toJson(), $actualEvent->toJson());
        self::assertEquals($expectedEvent->eventVersion(), $actualEvent->eventVersion());
    }
}
