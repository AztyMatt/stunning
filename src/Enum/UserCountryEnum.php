<?php

declare(strict_types=1);

namespace App\Enum;

enum UserCountryEnum: string
{
    case UNITED_STATES = 'United States';
    case CHINA = 'China';
    case ITALY = 'Italy';
    case BRAZIL = 'Brazil';
    case RUSSIA = 'Russia';
    case JAPAN = 'Japan';
    case GERMANY = 'Germany';
    case FRANCE = 'France';
    case UNITED_KINGDOM = 'United Kingdom';
    case CANADA = 'Canada';
}