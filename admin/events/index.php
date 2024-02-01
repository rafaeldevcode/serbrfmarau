<?php

    use Src\Models\Client;
    use Src\Models\Event;
    use Src\Models\Location;

    $method = empty(querys('method')) ? 'read' : querys('method');

    if($method == 'read'):
        $event = new Event();
        $requests = requests();
        $events = !isset($requests->search) ? $event->paginate(20) : $event->where('name', 'LIKE', "%{$requests->search}%")->paginate(20);
        $background = 'bg-secondary';
        $text  = 'Visualizar';
        $body = __DIR__."/body/read";

        $data = ['events' => $events];
    elseif($method == 'edit'):
        $event = new Event();
        $location = new Location();
        $client = new Client();

        $locations = getArraySelect($location->get(['id', 'name']), 'id', 'name');
        $clients = getArraySelect($client->get(['id', 'name']), 'id', 'name');
        $event = $event->find(querys('id'));
        $background = 'bg-success';
        $text  = 'Editar';
        $body = __DIR__."/body/form";

        $data = [
            'event' => $event->data, 
            'action' => '/admin/events/update',
            'locations' => $locations, 
            'clients' => $clients
        ];
    elseif($method == 'create'):
        if(redirectIfTotalEqualsZero('Src\Models\Location', '/admin/locations', 'Para adicionar um evento, primeiro adicione um local!')) die;

        $location = new Location();
        $client = new Client();

        $locations = getArraySelect($location->get(['id', 'name']), 'id', 'name');
        $clients = getArraySelect($client->get(['id', 'name']), 'id', 'name');
        $background = 'bg-primary';
        $text  = 'Adicionar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/events/create', 'locations' => $locations, 'clients' => $clients];
    endif;

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => $background,
        'type' => $text,
        'icon' => 'bi bi-calendar-event-fill',
        'title' => 'Eventos',
        'route_delete' => $method == 'read' ? '/admin/events/delete' : null,
        'route_add' => $method == 'create' ? null : '/admin/events?method=create',
        'route_search' => '/admin/events',
        'body' => $body,
        'data' => $data,
    ]);

    function loadInFooter(): void
    {
        loadHtml(__DIR__.'/../../resources/admin/partials/modal-delete');
    }
