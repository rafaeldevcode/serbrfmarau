<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Clients extends ExecuteMigrations
{
    public $table = 'clients';

    /**
     * @since 1.7.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('email', 50)->unique();
        $this->string('identifier', 20)->unique();
        $this->string('name', 100);
        $this->string('cpf', 11);
        $this->string('phone', 13);
        $this->string('city', 50);
        $this->string('street', 100);
        $this->string('neighborhood', 100);
        $this->integer('street_number');
        $this->char('type', 10);

        $this->timestamps();

        $this->create();
    }
}
