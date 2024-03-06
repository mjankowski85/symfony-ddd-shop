<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Domain\Exceptions;

final class NameIsTooShortException extends \Exception
{
    public static function create(string $name): self
    {
        return new self("Shop name {$name} is to long.");
    }
}
