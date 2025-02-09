<?php

declare(strict_types=1);

namespace App\Enum;

enum ProjectVisibilityEnum: string
{
    case PUBLIC = 'Public';
    case PRIVATE = 'Private';
}