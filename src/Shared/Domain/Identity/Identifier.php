<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shared\Domain\Identity;

abstract class Identifier
{
    protected function __construct(
        public readonly string $value
    ) {
    }

    public static function create(string $value): static
    {
        return new static($value);
    }

    public static function recreate(string $value): static
    {
        return new static($value);
    }
}
