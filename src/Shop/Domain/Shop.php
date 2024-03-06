<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Domain;

use Profitcatd\Recruitment\Shared\Domain\Identity\ShopId;
use Profitcatd\Recruitment\Shop\Domain\Events\ShopCreated;
use Profitcatd\Recruitment\Shop\Domain\Events\ShopNameChanged;
use Profitcatd\Recruitment\Shared\Domain\ObjectTypes\AggregateRoot;

final class Shop extends AggregateRoot
{
    private function __construct(
        private ShopId $id,
        private Name $name
    ) {
    }

    public static function create(ShopId $id, Name $name): self
    {
        $shop = new self($id, $name);
        $shop->raise(new ShopCreated($id, $name));

        return $shop;
    }

    public static function recreate(ShopId $id, Name $name): self
    {
        return new self($id, $name);
    }

    public function id(): ShopId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function changeName(Name $newName): void
    {
        if ($this->name->isEqual($newName)) {
            return;
        }

        $oldName = $this->name;
        $this->name = $newName;

        $this->raise(new ShopNameChanged($this->id, $oldName, $newName));
    }
}
