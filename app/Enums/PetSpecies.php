<?php

declare(strict_types=1);

namespace App\Enums;

enum PetSpecies: string
{
    case DOG = 'Cachorro';
    case CAT = 'Gato';
    case BIRD = 'Pássaro';
    case OTHER = 'Outro';
}