<?php

require __DIR__ .'/../../vendor/autoload.php';
require __DIR__ . '/../../suports/helpers.php';

use Src\Models\Setting;

verifyMethod(500, 'POST');

$setting = new Setting();
$requests = requests();
$current_setting = $setting->first();

$preloader = isset($requests->preloader) ? $requests->preloader : 'off';
$cookies = isset($requests->cookies) ? $requests->cookies : 'off';

$data = [
    'site_name' => $requests->site_name,
    'site_description' => $requests->site_description,
    'andress' => $requests->andress,
    'phone' => $requests->phone,
    'email' => $requests->email,
    'whatsapp' => $requests->whatsapp,
    'telegram' => $requests->telegram,
    'profile_linkedin' => $requests->profile_linkedin,
    'profile_facebook' => $requests->profile_facebook,
    'profile_instagram' => $requests->profile_instagram,
    'google_analytics' => $requests->google_analytics,
    'copyright' => $requests->copyright,
    'telegram_message' => $requests->telegram_message,
    'whatsapp_message' => $requests->whatsapp_message,
    'facebook_pixel' => $requests->facebook_pixel,
    'preloader' => $preloader,
    'cookies' => $cookies,
    'preloader_image' => $requests->preloader_image,
    'site_logo_main' => $requests->site_logo_main ?? null,
    'site_logo_secondary' => $requests->site_logo_secondary ?? null,
    'site_favicon' => $requests->site_favicon ?? null,
    'site_bg_login' => $requests->site_bg_login ?? null
];

if(!isset($current_setting)):

    $setting->create($data);
else:
    
    $setting->find($current_setting->id)->update($data);
endif;

unset($_SESSION['site_settings']);

session([
    'message' => 'Configurações atualizadas com sucesso!',
    'type' => 'cm-success'
]);

return header(route('/admin/settings', true), true, 302);
