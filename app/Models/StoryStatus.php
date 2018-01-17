<?php

namespace App\Models;

use App\Utils\Enum;

abstract class StoryStatus extends Enum
{
    const PUBLISHED = 'publicada';
    const DRAFT = 'borrador';
}
