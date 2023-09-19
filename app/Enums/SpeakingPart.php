<?php
  
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
 
enum SpeakingPart:string implements HasLabel {
    case PART1 = '1';
    case PART2 = '2';
    case PART3 = '3';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}