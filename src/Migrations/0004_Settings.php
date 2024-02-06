<?php

namespace Src\Migrations;

use Src\Migrations\ExecuteMigrations;

class Settings extends ExecuteMigrations
{
    public $table = 'settings';

    /**
     * @since 1.0.0
     * 
     * @return void
     */
    public function init()
    {
        $this->integer('id')->primaryKey();
        $this->string('site_name', 50)->nullable();
        $this->string('site_description', 100)->nullable();
        $this->string('copyright', 100)->nullable();
        $this->string('whatsapp_message', 255)->nullable();
        $this->string('telegram_message', 255)->nullable();
        $this->integer('site_logo_main')->nullable();
        $this->integer('site_logo_secondary')->nullable();
        $this->integer('site_favicon')->nullable();
        $this->integer('site_bg_login')->nullable();
        $this->char('preloader', 3)->default('off');
        $this->char('cookies', 3)->default('off');
        $this->char('maintenance', 3)->default('off');
        $this->char('construction', 3)->default('off');
        $this->string('preloader_image', 21)->default('preloader_default.gif');
        $this->string('facebook_pixel', 20)->nullable();
        $this->string('tiktok_pixel', 25)->nullable();
        $this->string('tagmanager_pixel', 20)->nullable();
        $this->string('googleads_pixel', 20)->nullable();
        $this->string('google_analytics_pixel', 20)->nullable();
        $this->string('profile_facebook', 100)->nullable();
        $this->string('profile_instagram', 100)->nullable();
        $this->string('profile_twitter', 100)->nullable();
        $this->string('profile_linkedin', 100)->nullable();
        $this->string('telegram', 20)->nullable();
        $this->string('whatsapp', 20)->nullable();
        $this->string('phone', 20)->nullable(0);
        $this->string('email', 50)->nullable();
        $this->string('andress', 120)->nullable();
        $this->timestamps();

        $this->create();
    }
}
