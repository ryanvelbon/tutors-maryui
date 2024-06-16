<?php

namespace App\Enums;

enum UserTitle: string
{
    case Mister = 'Mr.';
    case Misses = 'Mrs.';
    case Miss = 'Miss';
    case Doctor = 'Dr.';
    case Professor = 'Prof.';
}