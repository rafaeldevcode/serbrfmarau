<?php

namespace Src\Models;

/**
 * @since 1.7.0
 */
class Category extends Model
{
    public $table = 'categories';

    /**
     * @since 1.7.0
     * 
     * @return Location
     */
    public function locations(): Location
    {
        return $this->hasMany(Location::class, 'locations', 'category_id');
    }
}
