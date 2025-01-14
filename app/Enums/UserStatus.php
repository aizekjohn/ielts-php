<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserStatus:string implements HasLabel {
    case ACTIVE = 'active';
    case WAITING = 'waiting';
    case BLOCKED = 'blocked';

    public static function all(): array
    {
        return [
            self::ACTIVE->value,
            self::WAITING->value,
            self::BLOCKED->value,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
