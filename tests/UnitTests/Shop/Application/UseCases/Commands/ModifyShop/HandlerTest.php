<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\UnitTest\Shop\Application\UseCases\Commands\ModifyShop;

use Prophecy\Argument;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Profitcatd\Recruitment\Shop\Domain\Name;
use Profitcatd\Recruitment\Shop\Domain\Shop;
use Profitcatd\Recruitment\Shop\Domain\Repository;
use Profitcatd\Recruitment\Shop\Domain\Events\ShopNameChanged;
use Profitcatd\Recruitment\Tests\Support\Services\DomainInMemoryEventDispatcher;
use Profitcatd\Recruitment\Shop\Application\UseCases\Commands\ModifyShop\Command;
use Profitcatd\Recruitment\Shop\Application\UseCases\Commands\ModifyShop\Handler;
use Profitcatd\Recruitment\Tests\Support\MotherObjects\Shared\Domain\Identity\ShopId;
use Profitcatd\Recruitment\Tests\Support\MotherObjects\Shop\Domain\Shop as MotherShop;

final class HandlerTest extends TestCase
{
    use ProphecyTrait;

    public function testHandleWhenGivenValidParametersShouldModifyShop(): void
    {
        $shopId = ShopId::createAny();
        $oldName = Name::recreate('Walmart - North carolina branch limited liability company');
        $newName = Name::create('Walmart - South carolina branch limited liability company');
        $shop = MotherShop::newObject()
            ->withId($shopId)
            ->withName($oldName)
            ->recreate();

        $command = new Command(
            $shopId,
            $newName
        );

        $repository = $this->prophesize(Repository::class);
        /** @phpstan-ignore-next-line */
        $repository->find($shopId)->willReturn($shop);
        $dispatcher = new DomainInMemoryEventDispatcher();
        /** @phpstan-ignore-next-line */
        $SUT = new Handler($repository->reveal(), $dispatcher);

        $SUT->handle($command);

        /** @phpstan-ignore-next-line */
        $repository->save(Argument::type(Shop::class))->shouldHaveBeenCalled();
        self::assertTrue($dispatcher->eventHasBeenDispatched(ShopNameChanged::EVENT_NAME, $shopId->value));
        self::assertEquals($newName, $shop->name());
    }
}
