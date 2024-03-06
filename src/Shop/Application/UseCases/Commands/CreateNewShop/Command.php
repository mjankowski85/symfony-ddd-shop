<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Application\UseCases\Commands\CreateNewShop;

use Profitcatd\Recruitment\Shop\Domain\Name;
use Profitcatd\Recruitment\Shared\Domain\Identity\ShopId;

final readonly class Command
{
    public function __construct(
        public ShopId $id,
        public Name $name
    ) {
    }
}
