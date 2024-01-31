<?php
    verifyMethod(500, 'POST');
    
    use Src\Models\Client;

    $requests = requests();
    $client = new Client;

    $client = $client->find($requests->id);
        
    $client->update([
        'name' => $requests->name,
        'phone' => preg_replace('/[^0-9]/', '', $requests->phone),
        'cpf' => preg_replace('/[^0-9]/', '', $requests->cpf),
        'city' => $requests->city,
        'street' => $requests->street,
        'neighborhood' => $requests->neighborhood,
        'street_number' => $requests->street_number,
        'type' => $requests->type
    ]);
    
    session([
        'message' => 'Cliente editado com sucesso!',
        'type'    => 'success'
    ]);
    
    return header(route('/admin/clients', true), true, 302);
