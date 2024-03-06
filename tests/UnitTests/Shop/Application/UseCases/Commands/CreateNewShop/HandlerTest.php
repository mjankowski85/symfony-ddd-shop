<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\UnitTest\Shop\Application\UseCases\Commands\CreateNewShop;

use Prophecy\Argument;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Profitcatd\Recruitment\Shop\Domain\Name;
use Profitcatd\Recruitment\Shop\Domain\Shop;
use Profitcatd\Recruitment\Shop\Domain\Repository;
use Profitcatd\Recruitment\Shop\Domain\Events\ShopCreated;
use Profitcatd\Recruitment\Tests\Support\Services\DomainInMemoryEventDispatcher;
use Profitcatd\Recruitment\Shop\Application\UseCases\Commands\CreateNewShop\Command;
use Profitcatd\Recruitment\Shop\Application\UseCases\Commands\CreateNewShop\Handler;
use Profitcatd\Recruitment\Tests\Support\MotherObjects\Shared\Domain\Identity\ShopId;

final class HandlerTest extends TestCase
{
    use ProphecyTrait;

    public function testHandleWhenGivenValidParametersShouldSaveShop(): void
    {
        $shopId = ShopId::createAny();
        $name = Name::create('Walmart - North carolina branch limited liability company');
        $command = new Command(
            $shopId,
            $name
        );
        $repository = $this->prophesize(Repository::class);
        $dispatcher = new DomainInMemoryEventDispatcher();
        /** @phpstan-ignore-next-line */
        $SUT = new Handler($repository->reveal(), $dispatcher);

        $SUT->handle($command);

        /** @phpstan-ignore-next-line */
        $repository->save(Argument::type(Shop::class))->shouldHaveBeenCalled();
        self::assertTrue($dispatcher->eventHasBeenDispatched(ShopCreated::EVENT_NAME, $shopId->value));
    }
}
