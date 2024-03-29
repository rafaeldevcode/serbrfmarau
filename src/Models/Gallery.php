<?php

namespace Src\Models;

class Gallery extends Model
{
    public $table = 'gallery';

    /**
     * @since 1.7.0
     * 
     * @return Location
     */
    public function locations(): Location
    {
        return $this->belongsToMany(Location::class, 'location_images', 'image_id', 'location_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Category
     */
    public function categories(): Category
    {
        return $this->hasMany(Category::class, 'categories', 'thumbnail');
    }
}
