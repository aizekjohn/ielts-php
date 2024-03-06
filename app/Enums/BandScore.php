<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum BandScore:string implements HasLabel {
    case BAND50 = '5';
    case BAND55 = '5.5';
    case BAND60 = '6';
    case BAND65 = '6.5';
    case BAND70 = '7';
    case BAND75 = '7.5';
    case BAND80 = '8';
    case BAND85 = '8.5';
    case BAND90 = '9';

    public static function all(): array
    {
        return [
            self::BAND50->value,
            self::BAND55->value,
            self::BAND60->value,
            self::BAND65->value,
            self::BAND70->value,
            self::BAND75->value,
            self::BAND80->value,
            self::BAND85->value,
            self::BAND90->value,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
