<?php

namespace App\Models\Enums;

use App\Utils\Enum;

class Visualization extends Enum
{
    const BUBBLE = 'bubble';
    const WORDS = 'words';
    const RIZOME = 'rizome';

    const LIST = [
        Typology::EPISODIC => [
            Visualization::BUBBLE,
            Visualization::WORDS,
        ],
        Typology::RIZOME => [
            Visualization::RIZOME
        ],
    ];
}
