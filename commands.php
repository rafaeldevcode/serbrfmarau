<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/suports/helpers/env.php';

use Src\Models\Migrations;
use Src\Migrations\ExecuteMigrations;
use Src\Models\Gallery;
use Src\Models\Setting;
use Src\Models\User;

if(isset($argv[1])):
    if($argv[1] == 'migrate'):
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
    elseif($argv[1] == 'initial-setup'):
        $user = new User();
        $gallery = new Gallery();
        $settings = new Setting();

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
    elseif($argv[1] == 'change-color-svg'):
        if(isset($argv[2]) || isset($argv[3])):
            $old_color = strtolower($argv[2]);
            $new_color = strtolower($argv[3]);
            
            $path = __DIR__.'/public/assets/images/';
            $images = scandir($path);
            $images = array_filter($images, function($item){
                return strpos($item, '.svg') !== false ? true : false;
            });
    
            foreach($images as $image):
                $svg_content = file_get_contents("{$path}{$image}");
    
                $new_svg_content = str_replace($old_color, $new_color, $svg_content);
                
                file_put_contents("{$path}{$image}", $new_svg_content);
            endforeach;

            echo "Colors changed successfully!";
        else:
            echo "It is necessary to inform the old color and the new color!";
        endif;
    endif;
endif;
