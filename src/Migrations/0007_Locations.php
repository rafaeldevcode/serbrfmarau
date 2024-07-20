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
        $this->char('start_hour', 5);
        $this->char('end_hour', 5);
        $this->char('opening', 3);
        $this->text('prices');
        $this->text('description')->nullable();
        $this->string('opening_days', 255);
        $this->char('type', 6)->nullable();
        $this->char('status', 3)->default('on');

        $this->integer('user_id');
        $this->integer('category_id');

        $this->foreignKey('user_id')->references('id')->on('users');
        $this->foreignKey('category_id')->references('id')->on('categories');

        $this->timestamps();

        $this->create();
    }
}
