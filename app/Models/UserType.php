<?php

namespace App\Models;

use App\Utils\Enum;

interface UserType extends Enum
{
    const ADMIN = 1;
    const MOD = 2;
    const WRITER = 3;
}
