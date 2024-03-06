<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\UnitTest\Shop\Domain;

use PHPUnit\Framework\TestCase;
use Profitcatd\Recruitment\Shop\Domain\Name;
use Profitcatd\Recruitment\Shop\Domain\Exceptions\NameIsTooShortException;

final class NameTest extends TestCase
{
    public function testCreateWhenGivenValidNameShouldCreateObject(): void
    {
        $name = 'Walmart';

        $SUT = Name::create($name);

        self::assertEquals($name, $SUT->value);
    }

    public function testRecreateWhenGivenValidNameShouldRecreateObject(): void
    {
        $name = 'Walmart';

        $SUT = Name::recreate($name);

        self::assertEquals($name, $SUT->value);
    }

    /**
     * @dataProvider provideTooShortName
     */
    public function testCreateWhenGivenTooShortNameShouldThrowException(string $name): void
    {
        self::expectExceptionObject(NameIsTooShortException::create($name));

        Name::create($name);
    }

    /**
     * @return mixed[]
     */
    public static function provideTooShortName(): array
    {
        return [
            'only white character' => [' '],
            'zero length string' => [''],
        ];
    }
}
