<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\Support\MotherObjects\Shared\Domain\Identity;

use Profitcatd\Recruitment\Shared\Domain\Identity\ShopId as BaseShopId;

final class ShopId
{
    private function __construct()
    {
    }

    public static function createAny(): BaseShopId
    {
        return BaseShopId::create('5c9259d1-372e-42c4-91ca-1a74c2f3495a');
    }
}
