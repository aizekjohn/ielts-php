<?php
  
namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
 
enum UserStatus:string implements HasLabel {
    case Active = 'active';
    case Waiting = 'waiting';
    case Blocked = 'blocked';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}