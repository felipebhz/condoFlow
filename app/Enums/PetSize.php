<?php

declare(strict_types=1);

namespace App\Enums;

enum PetSize: string
{
    case SMALL = 'Pequeno';
    case MEDIUM = 'Médio';
    case LARGE = 'Grande';
}