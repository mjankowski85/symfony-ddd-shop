<?php

declare(strict_types=1);

namespace Profitcatd\Recruitment\Shop\Domain\Events;

use Profitcatd\Recruitment\Shop\Domain\Name;
use Profitcatd\Recruitment\Shared\Domain\Identity\ShopId;
use Profitcatd\Recruitment\Shared\Domain\ObjectTypes\Event;

final readonly class ShopNameChanged extends Event
{
    public const EVENT_NAME = 'shop_name_changed';

    public const EVENT_VERSION = 1;

    public function __construct(
        public ShopId $id,
        public Name $oldName,
        public Name $newName,
    ) {
        parent::__construct($id, self::EVENT_NAME, self::EVENT_VERSION);
    }

    public function toJson(): string
    {
        return (string) json_encode([
            'id' => $this->id->value,
            'before' => [
                'name' => $this->oldName->value,
            ],
            'after' => [
                'name' => $this->newName->value,
            ],
        ]);
    }
}
