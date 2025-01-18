<?php
    verifyMethod(500, 'POST');

    use Src\Models\Banners;

    $banner = new Banners();
    $requests = requests();
    $message = 'Banner(s) removida(s) com sucesso!';
    $type = 'success';

    foreach($requests->ids as $ID):
        $banner->find($ID);
    endforeach;

    session([
        'message' => $message,
        'type' => $type
    ]);

    return header(route('/admin/banners', true), true, 302);
