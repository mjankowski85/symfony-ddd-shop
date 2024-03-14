<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Domain;

use Profitcatd\Recruitment\Shop\Domain\Exceptions\NameIsTooShortException;

final readonly class Name
{
    private const MIN_ADMISSIBLE_LENGTH = 1;

    private function __construct(
        public string $value
    ) {
    }

    /**
     * @throws NameIsTooShortException
     */
    public static function create(string $value): static
    {
        $trimmedValue = trim($value);
        $valueLength = \mb_strlen($trimmedValue);
        if ($valueLength < static::MIN_ADMISSIBLE_LENGTH) {
            throw NameIsTooShortException::create($value);
        }

        return new static($value);
    }

    public static function recreate(string $value): static
    {
        return new static($value);
    }

    public function isEqual(Name $name): bool
    {
        return $name->value === $this->value;
    }
}
