<?php
    verifyMethod(500, 'POST');
    
    use Src\Models\Client;

    $requests = requests();
    $client = new Client();

    $client->create([
        'name' => $requests->name,
        'phone' => preg_replace('/[^0-9]/', '', $requests->phone),
        'cpf' => preg_replace('/[^0-9]/', '', $requests->cpf),
        'city' => $requests->city,
        'street' => $requests->street,
        'neighborhood' => $requests->neighborhood,
        'street_number' => $requests->street_number,
        'type' => $requests->type,
        'identifier' => generateIdentifier(20)
    ]);
    
    session([
        'message' => 'Cliente adicionado com sucesso!',
        'type'    => 'success'
    ]);
    
    return header(route('/admin/clients', true), true, 302);
