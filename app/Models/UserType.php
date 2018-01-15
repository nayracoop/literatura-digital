<?php

namespace App\Models;

use App\Utils\Enum;

abstract class UserType extends Enum
{
    const ADMIN = 'administrador';
    const MOD = 'moderador';
    const AUTHOR = 'autor';
}
