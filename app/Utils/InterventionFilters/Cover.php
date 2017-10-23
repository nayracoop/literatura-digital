<?php

namespace App\Utils\InterventionFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Cover implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(200, 200);        
    }
}
