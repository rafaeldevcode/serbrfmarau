<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class PostImages extends ExecuteMigrations
{
    public $table = 'post_images';

    /**
     * @since 1.3.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('post_id');
        $this->integer('image_id');

        $this->create();
    }
}
