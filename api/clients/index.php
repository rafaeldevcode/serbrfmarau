<?php

    use Src\Models\Client;

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
        $requests = requests();
        $client = new Client();

        $clients = $client->where('cpf_cnpj', 'LIKE', "%{$requests->search}%")->get();

        $data = ['success' => true, 'data' => $clients];
    else:
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    endif;

    echo json_encode($data);
