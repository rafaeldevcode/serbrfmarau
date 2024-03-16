<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class ChangeSettings extends ExecuteMigrations
{
    public $table = 'settings';

    /**
     * @since 1.0.0
     * 
     * @return void
     */
    public function init()
    {
        $this->string('pix_key', 100)->after('last_cron')->nullable();

        $this->update();
    }
}
