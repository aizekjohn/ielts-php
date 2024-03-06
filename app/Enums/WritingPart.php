<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WritingPart:string implements HasLabel {
    case PART1 = '1';
    case PART2 = '2';

    public static function all(): array
    {
        return [
            self::PART1->value,
            self::PART2->value,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
