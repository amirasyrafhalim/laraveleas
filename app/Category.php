<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title'];

    /**
     * A category is belongs to many events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Query scope find skill by title.
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public static function scopeByTitleContains($query, $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }
}