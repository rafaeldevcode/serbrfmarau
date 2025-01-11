<?php

namespace Src\Models;

class Posts extends Model
{
    public $table = 'posts';

    /**
     * @since 1.3.0
     * 
     * @return Gallery
     */
    public function images(): Gallery
    {
        return $this->belongsToMany(Gallery::class, 'post_images', 'post_id', 'image_id');
    }

    /**
     * @since 1.3.1
     * 
     * @return Gallery
     */
    public function thumbnail(): Gallery
    {
        return $this->belongsTo(User::class, 'gallery', 'thumbnail');
    }

    /**
     * @since 1.3.1
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
