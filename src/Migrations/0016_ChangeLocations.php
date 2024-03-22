<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class ChangeLocations extends ExecuteMigrations
{
    public $table = 'locations';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->string('email', 50)->after('name');

        $this->update();
    }
}
