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

    /**
     * @since 1.7.0
     * 
     * @return Posts
     */
    public function posts(): Posts
    {
        return $this->hasMany(Posts::class, 'posts', 'category_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Gallery
     */
    public function thumbnail(): Gallery
    {
        return $this->belongsTo(User::class, 'gallery', 'thumbnail');
    }
}
