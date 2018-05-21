<?php

namespace App\Utils\InterventionFilters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Upload implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->resize(null, 380, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}
