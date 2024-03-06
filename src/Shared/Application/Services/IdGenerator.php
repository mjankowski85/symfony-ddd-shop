<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shared\Application\Services;

interface IdGenerator
{
    public function newId(): string;
}
