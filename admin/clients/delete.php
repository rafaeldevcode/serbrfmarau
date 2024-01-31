<?php
    verifyMethod(500, 'POST');
    
    use Src\Models\Client;

    $client = new Client;
    $requests = requests();

    foreach($requests->ids as $ID):
        $client->find($ID)->delete();
    endforeach;

    session([
        'message' => 'Cliente(s) removido(s) com sucesso!',
        'type'    => 'success'
    ]);

    return header(route('/admin/clients', true), true, 302);
