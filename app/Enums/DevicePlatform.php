<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DevicePlatform:string implements HasLabel {
    case ANDROID = 'android';
    case IOS = 'ios';

    public static function all(): array
    {
        return [
            self::ANDROID->value,
            self::IOS->value,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
