<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Protocols extends ExecuteMigrations
{
    public $table = 'protocols';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();

        $this->integer('reservation_id');
        $this->string('reservation_status', 10)->default('Pendente');
        $this->string('token', 200)->unique();

        $this->foreignKey('reservation_id')->references('id')->on('reservations');

        $this->timestamps();

        $this->create();
    }
}
