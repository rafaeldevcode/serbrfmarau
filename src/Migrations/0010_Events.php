<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Events extends ExecuteMigrations
{
    public $table = 'events';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('name', 150);
        $this->char('type', 50);
        $this->string('payment_type', 20);
        // $this->string('event_type', 20);
        $this->integer('amount_people');
        $this->string('status', 10);
        $this->string('event', 12);
        $this->text('observation')->nullable();
        $this->char('period', 5);

        $this->integer('location_id');
        $this->integer('client_id');

        $this->foreignKey('location_id')->references('id')->on('locations');
        $this->foreignKey('client_id')->references('id')->on('clients');

        $this->timestamps();

        $this->create();
    }
}
