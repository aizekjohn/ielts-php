<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserGender:string implements HasLabel {
    case MALE = 'male';
    case FEMALE = 'female';

    public static function all(): array
    {
        return [
            self::MALE->value,
            self::FEMALE->value,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
