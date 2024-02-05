<?php

use Src\Models\Migrations;
use Src\Migrations\ExecuteMigrations;
use Src\Models\Gallery;
use Src\Models\Setting;
use Src\Models\User;

$requests = requests();

if($requests->action):
    if($requests->action == 'migrate'):
        $executeMigrations = new ExecuteMigrations();
        $migrations = new Migrations();

        $migrations_exists = $executeMigrations->verifyExistsMigrations();
        $contents = scandir(__DIR__.'/src/Migrations/');
        $contents = array_slice($contents, 2, -1);
        $migrates = [];

        foreach($contents as $file):
            if(!$migrations_exists || empty($migrations->where('name', '=', $file)->get())):
                $class = explode('.', $file)[0];

                require __DIR__."/src/Migrations/{$file}";
                $class = "Src\\Migrations\\".substr($class, 5);

                echo "Running the '{$class}' migration.\n";

                $exec = new $class;
                $exec->init();

                $migrations->create(['name' => $file]);

                array_push($migrates, $file);
                $migrations_exists = true;

                echo "Migration from {$class} finished!\n\n";
            endif;
        endforeach;

        echo empty($migrates) ? "No migration to perform!\n" : "Migration finished! \n";
    elseif($requests->action == 'initial-setup'):
        $user = new User();
        $gallery = new Gallery();
        $settings = new Setting();

        if($user->count() === 0):
            $name = 'Administrador';
            $email = 'administrador@example.com';
            $password = '@Admin4431!';

            $user = $user->create([
                'name'     => $name,
                'email'    => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT)
            ]);

            $favicon = $gallery->create([
                'name' => 'favicon',
                'file' => 'favicon.svg',
                'user_id' => $user->id,
                'size' => 0
            ]);

            $logo_main = $gallery->create([
                'name' => 'logo main',
                'file' => 'logo_main.svg',
                'user_id' => $user->id,
                'size' => 0
            ]);

            $logo_secondary = $gallery->create([
                'name' => 'logo secondary',
                'file' => 'logo_secondary.png',
                'user_id' => $user->id,
                'size' => 0
            ]);

            $bg_login = $gallery->create([
                'name' => 'bg login',
                'file' => 'bg_login.jpg',
                'user_id' => $user->id,
                'size' => 0
            ]);

            $settings->create([
                'site_logo_main' => $logo_main->id,
                'site_logo_secondary' => $logo_secondary->id,
                'site_favicon' => $favicon->id,
                'site_bg_login' => $bg_login->id
            ]);

            echo "Email: {$email} \n";
            echo "Senha: {$password} \n";
        else:
            echo "Initial setup already executed \n";
        endif;
    endif;
endif;
