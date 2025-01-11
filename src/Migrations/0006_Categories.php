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
        $this->text('description', 255)->nullable();
        $this->string('type', 10)->default('location');
        $this->integer('thumbnail')->nullable();

        $this->foreignKey('thumbnail')->references('id')->on('gallery');

        $this->timestamps();

        $this->create();
    }
}
