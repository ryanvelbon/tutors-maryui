<?php

namespace App\Enums;

enum LessonStatus: string
{
    case Scheduled = 'scheduled';
    case InProgress = 'in progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
}
