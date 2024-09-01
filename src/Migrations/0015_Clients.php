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

        $this->string('cpf_cnpj', 14)->unique();
        $this->string('email', 50);
        $this->string('phone', 14);
        $this->integer('amount_people');
        $this->string('event', 13);
        $this->string('payment_type', 20);

        $this->create();
    }
}
