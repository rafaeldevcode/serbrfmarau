<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class ChangeReservations extends ExecuteMigrations
{
    public $table = 'reservations';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->text('observation_payment')->after('day')->nullable();

        $this->update();
    }
}
