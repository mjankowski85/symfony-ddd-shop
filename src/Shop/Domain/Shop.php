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
        private Name $name,
        private VerificationStatus $verificationStatus,
    ) {
    }

    public static function create(ShopId $id, Name $name): static
    {
        $varificationStatus = VerificationStatus::TO_VERIFICATION;
        $shop = new static($id, $name, $varificationStatus);
        $shop->raise(new ShopCreated($id, $name, $varificationStatus));

        return $shop;
    }

    public static function recreate(ShopId $id, Name $name, VerificationStatus $varificationStatus): static
    {
        return new static($id, $name, $varificationStatus);
    }

    public function id(): ShopId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function varificationStatus(): VerificationStatus
    {
        return $this->verificationStatus;
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

    // public function setStatus(Status $status): void
    // {

    // }
}
