<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Payments extends ExecuteMigrations
{
    public $table = 'payments';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('token', 20);
        $this->char('status', 3)->default('off');

        $this->integer('reservation_id');
        $this->foreignKey('reservation_id')->references('id')->on('reservations');

        $this->create();
    }
}
