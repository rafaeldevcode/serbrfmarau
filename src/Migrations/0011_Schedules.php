<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Schedules extends ExecuteMigrations
{
    public $table = 'schedules';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->integer('number_day')->nullable();
        $this->char('string_day', 7)->nullable();
        $this->char('hour', 5);

        $this->integer('event_id');

        $this->foreignKey('event_id')->references('id')->on('events');

        $this->timestamps();

        $this->create();
    }
}
