<?php

namespace App\Models\Enums;

use App\Utils\Enum;

abstract class StoryStatus extends Enum
{
    const PUBLISHED = 'publicado';
    const DRAFT = 'borrador';
}
