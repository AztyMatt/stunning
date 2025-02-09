<?php

declare(strict_types=1);

namespace App\Enum;

enum MediaTypeEnum: string
{
    case IMAGE = 'Image';
    case VIDEO = 'Video';
}