<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Domain;

use Profitcatd\Recruitment\Shared\Domain\Identity\ShopId;

interface Repository
{
    public function save(Shop $shop): void;

    public function find(ShopId $id): Shop;
}
