<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\Support\MotherObjects\Shop\Domain;

use Profitcatd\Recruitment\Shop\Domain\Name as BaseName;

final class Name
{
    private function __construct()
    {
    }

    public static function createAny(): BaseName
    {
        return BaseName::create('Walmart');
    }
}
