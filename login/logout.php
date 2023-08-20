<?php

require __DIR__ .'/../vendor/autoload.php';
require __DIR__ . '/../suports/helpers.php';

autenticate();
verifyMethod(500, 'POST');

use Src\Models\User;

$user_id = isset($_POST['id']) ? $_POST['id'] : null;
$redirection = '/login';

$user = new User();
$user->logout($user_id);

if(isset($user_id)):
    session([
        'message' => 'Logout realizado com sucesso!',
        'type' => 'cm-success'
    ]);

    $redirection = '/admin/users';
endif;

return header(route($redirection, true), true, 302);
