<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class LocationImages extends ExecuteMigrations
{
    public $table = 'location_images';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('location_id');
        $this->integer('image_id');

        $this->create();
    }
}
