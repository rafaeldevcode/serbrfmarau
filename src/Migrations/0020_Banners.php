<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Banners extends ExecuteMigrations
{
    public $table = 'banners';

    /**
     * @since 1.3.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('title', 255);
        $this->string('subtitle', 255)->nullable();
        $this->string('link', 200)->nullable();
        $this->char('status', 3)->default('on');
        $this->integer('desktop')->nullable();
        $this->integer('mobile')->nullable();

        $this->timestamps();

        $this->create();
    }
}
