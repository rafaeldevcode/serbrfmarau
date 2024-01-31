<?php

namespace Src\Models;

class Location extends Model
{
    public $table = 'locations';

    /**
     * @since 1.7.0
     * 
     * @return Gallery
     */
    public function images(): Gallery
    {
        return $this->belongsToMany(Gallery::class, 'location_images', 'location_id', 'image_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return User
     */
    public function user(): User
    {
        return $this->belongsTo(User::class, 'users', 'user_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Category
     */
    public function category(): Category
    {
        return $this->belongsTo(Category::class, 'categories', 'category_id');
    }
}
