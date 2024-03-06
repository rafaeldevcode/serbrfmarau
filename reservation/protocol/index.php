<?php
    loadHtml(__DIR__.'/body/read', [
        'image' => !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? 'assets/images/'.SETTINGS['site_bg_login'] : 'assets/images/login_bg.jpg',
        'reservation' => null
    ]);
