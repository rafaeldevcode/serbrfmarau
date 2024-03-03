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
        $this->date('date')->nullable();
        $this->char('day', 9)->nullable();
        $this->char('hour', 5);

        $this->integer('reservation_id');
        $this->integer('location_id');

        $this->foreignKey('reservation_id')->references('id')->on('reservations');
        $this->foreignKey('location_id')->references('id')->on('locations');

        $this->timestamps();

        $this->create();
    }
}
