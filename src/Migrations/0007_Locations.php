<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Locations extends ExecuteMigrations
{
    public $table = 'locations';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();

        $this->string('name', 255);
        $this->string('city', 50);
        $this->string('street', 100);
        $this->string('neighborhood', 100);
        $this->integer('street_number');
        $this->date('start_date');
        $this->date('end_date');
        $this->string('opening', 30);
        $this->char('status', 3)->default('on');

        $this->integer('user_id');
        $this->integer('category_id');

        $this->foreignKey('user_id')->references('id')->on('users');
        $this->foreignKey('category_id')->references('id')->on('categories');

        $this->timestamps();

        $this->create();
    }
}
