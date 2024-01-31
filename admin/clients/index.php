<?php
    use Src\Models\Client;

    $method = empty(querys('method')) ? 'read' : querys('method');

    if($method == 'read'):
        $client = new Client();
        $requests = requests();
        $clients = !isset($requests->search) ? $client->paginate(20) : $client->where('name', 'LIKE', "%{$requests->search}%")->paginate(20);
        $background = 'bg-secondary';
        $text  = 'Visualizar';
        $body = __DIR__."/body/read";

        $data = ['clients' => $clients];
    elseif($method == 'edit'):
        $client = new Client();

        $client = $client->find(querys('id'));
        $background = 'bg-success';
        $text  = 'Editar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/clients/update', 'client' => $client->data];
    elseif($method == 'create'):
        $background = 'bg-primary';
        $text  = 'Adicionar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/clients/create'];
    endif;

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background'        => $background,
        'type'         => $text,
        'icon'         => 'bi bi-pin-angle-fill',
        'title'        => 'clients',
        'route_delete' => $method == 'read' ? '/admin/clients/delete' : null,
        'route_add'    => $method == 'create' ? null : '/admin/clients?method=create',
        'route_search' => '/admin/clients',
        'body' => $body,
        'data' => $data
    ]);

    function loadInFooter(): void
    {
        loadHtml(__DIR__.'/../../resources/admin/partials/modal-delete');
    }
