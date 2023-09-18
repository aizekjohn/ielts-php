<?php
  
namespace App\Enums;
 
enum UserStatus:string {
    case Active = 'active';
    case Waiting = 'waiting';
    case Blocked = 'blocked';
}