<?php

namespace App\Enums;

enum CourseOfferingStatus: string
{
    case Scheduled = 'scheduled';
    case InProgress = 'in progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function getColor(): string
    {
        return match ($this) {
            self::Scheduled => 'info',
            self::InProgress => 'warning',
            self::Completed => 'success',
            self::Cancelled => 'error',
        };
    }
}
