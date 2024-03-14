<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\UnitTest\Shop\Domain;

use PHPUnit\Framework\TestCase;
use Profitcatd\Recruitment\Shop\Domain\Name;
use Profitcatd\Recruitment\Shop\Domain\Shop;
use Profitcatd\Recruitment\Shop\Domain\Events\ShopCreated;
use Profitcatd\Recruitment\Shop\Domain\Events\ShopNameChanged;
use Profitcatd\Recruitment\Tests\Support\Utils\DomainEventAssertion;
use Profitcatd\Recruitment\Tests\Support\MotherObjects as motherObjects;
use Profitcatd\Recruitment\Shop\Domain\VerificationStatus;

final class ShopTest extends TestCase
{
    use DomainEventAssertion;

    public function testCreateWhenGivenValidParametersShouldCreateObject(): void
    {
        $id = motherObjects\Shared\Domain\Identity\ShopId::createAny();
        $name = motherObjects\Shop\Domain\Name::createAny();
        $varificationStatus = VerificationStatus::TO_VERIFICATION;

        $SUT = Shop::create($id, $name, $varificationStatus);

        self::assertEquals($id, $SUT->id());
        self::assertEquals($name, $SUT->name());
        self::assertEquals($varificationStatus, $SUT->varificationStatus());
    }

    public function testCreateWhenGivenValidParametersEventIsRaised(): void
    {
        $id = motherObjects\Shared\Domain\Identity\ShopId::createAny();
        $name = motherObjects\Shop\Domain\Name::createAny();
        $expectedEvent = new ShopCreated($id, $name);

        $SUT = Shop::create($id, $name);

        $events = $SUT->pullEvents();
        self::assertDomainEvent($expectedEvent, $events[0]);
        self::assertCount(1, $events);
    }

    public function testRecreateWhenGivenValidParametersShouldRecreateObject(): void
    {
        $id = motherObjects\Shared\Domain\Identity\ShopId::createAny();
        $name = motherObjects\Shop\Domain\Name::createAny();

        $SUT = Shop::recreate($id, $name);

        self::assertEquals($id, $SUT->id());
        self::assertEquals($name, $SUT->name());
    }

    public function testChangeNameWhenGivenNewNameShouldChangeName(): void
    {
        $oldName = Name::recreate('Old Name');
        $newName = Name::recreate('New Name');
        $SUT = motherObjects\Shop\Domain\Shop::newObject()
            ->withName($oldName)
            ->recreate();

        $SUT->changeName($newName);

        self::assertEquals($newName, $SUT->name());
    }

    public function testChangeNameWhenGivenNewNameEventIsRaised(): void
    {
        $oldName = Name::recreate('Old Name');
        $newName = Name::recreate('New Name');
        $id = motherObjects\Shared\Domain\Identity\ShopId::createAny();
        $SUT = motherObjects\Shop\Domain\Shop::newObject()
            ->withId($id)
            ->withName($oldName)
            ->recreate();
        $expectedEvent = new ShopNameChanged($id, $oldName, $newName);

        $SUT->changeName($newName);

        $events = $SUT->pullEvents();

        self::assertDomainEvent($expectedEvent, $events[0]);
        self::assertCount(1, $events);
    }

}
