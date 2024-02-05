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

        $this->integer('event_id');
        $this->integer('client_id');
        $this->string('event_status', 10);
        $this->string('token', 200)->unique();

        $this->foreignKey('event_id')->references('id')->on('events');
        $this->foreignKey('client_id')->references('id')->on('clients');

        $this->timestamps();

        $this->create();
    }
}
