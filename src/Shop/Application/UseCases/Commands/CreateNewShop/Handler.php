<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Application\UseCases\Commands\CreateNewShop;

use Profitcatd\Recruitment\Shop\Domain\Shop;
use Profitcatd\Recruitment\Shop\Domain\Repository;
use Profitcatd\Recruitment\Shared\Application\Services\DomainEventDispatcher;

final class Handler
{
    public function __construct(
        private Repository $repository,
        private DomainEventDispatcher $dispatcher
    ) {
    }

    public function handle(Command $command): void
    {
        $shop = Shop::create($command->id, $command->name);
        $this->repository->save($shop);

        $this->dispatcher->dispatch(...$shop->pullEvents());
    }
}
