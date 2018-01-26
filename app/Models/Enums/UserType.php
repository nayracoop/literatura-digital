<?php

namespace App\Models\Enums;

use App\Utils\Enum;

abstract class UserType extends Enum
{
    const ADMIN = 'administrador';
    const MOD = 'moderador';
    const AUTHOR = 'autor';
}
