<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Tests\Support\MotherObjects\Shop\Domain;

use Profitcatd\Recruitment\Shop\Domain as shopDomain;
use Profitcatd\Recruitment\Shared\Domain\Identity\ShopId;
use Profitcatd\Recruitment\Tests\Support\MotherObjects\Shared\Domain\Identity as mothersObjectIdentity;

final class Shop
{
    private function __construct(
        private ShopId $shopId,
        private shopDomain\Name $name
    ) {
    }

    public static function newObject(): self
    {
        return new self(
            mothersObjectIdentity\ShopId::createAny(),
            Name::createAny()
        );
    }

    public function create(): shopDomain\Shop
    {
        return shopDomain\Shop::create(
            $this->shopId,
            $this->name
        );
    }

    public function recreate(): shopDomain\Shop
    {
        return shopDomain\Shop::recreate(
            $this->shopId,
            $this->name
        );
    }

    public function withId(ShopId $shopId): self
    {
        $this->shopId = $shopId;

        return $this;
    }

    public function withName(shopDomain\Name $name): self
    {
        $this->name = $name;

        return $this;
    }
}
