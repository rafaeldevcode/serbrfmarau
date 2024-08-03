<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Reservations extends ExecuteMigrations
{
    public $table = 'reservations';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('name', 150);
        $this->string('email', 50);
        $this->string('phone', 14);
        $this->string('identifier')->nullable();
        $this->char('type', 50);
        $this->string('payment_type', 20);
        // $this->string('event_type', 20);
        $this->integer('amount_people');
        $this->string('event', 13);
        $this->text('observation')->nullable();
        $this->char('period', 6)->nullable();
        $this->date('date')->nullable();
        $this->char('day', 9)->nullable();
        $this->string('status', 10)->default('Pendente');
        $this->char('is_partner', 3)->default('off');

        $this->integer('location_id');

        $this->foreignKey('location_id')->references('id')->on('locations');

        $this->timestamps();

        $this->create();
    }
}
