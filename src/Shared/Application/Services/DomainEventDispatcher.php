<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shared\Application\Services;

use Profitcatd\Recruitment\Shared\Domain\ObjectTypes\Event;

interface DomainEventDispatcher
{
    public function dispatch(Event ...$events): void;
}
