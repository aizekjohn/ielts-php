<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum WritingPart:string implements HasLabel {
    case TASK1 = '1';
    case TASK2 = '2';

    public static function all(): array
    {
        return [
            self::TASK1->value,
            self::TASK2->value,
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
