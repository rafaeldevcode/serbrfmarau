<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Categories extends ExecuteMigrations
{
    public $table = 'categories';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('name', 50);
        $this->integer('image_id');

        $this->timestamps();

        $this->create();
    }
}
