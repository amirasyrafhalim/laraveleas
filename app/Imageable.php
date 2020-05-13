<?php

namespace App;

use App\Image;

trait Imageable
{
    /**
     * A model has many images.
     *
     * @return mixed
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}

