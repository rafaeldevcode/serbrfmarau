<?php

    use Src\Models\Reservation;
    use Src\Models\Location;

    $method = empty(querys('method')) ? 'read' : querys('method');

    if($method == 'read'):
        $reservation = new Reservation();

        $reservations = filterReservations($reservation);
        $background = 'bg-secondary';
        $text  = 'Visualizar';
        $body = __DIR__."/body/read";

        $data = ['reservations' => $reservations];
    elseif($method == 'edit'):
        $reservation = new Reservation();
        $location = new Location();

        $locations = getArraySelect($location->where('status', '=', 'on')->get(['id', 'name']), 'id', 'name');
        $reservation = $reservation->find(querys('id'));
        $background = 'bg-success';
        $text  = 'Editar';
        $body = __DIR__."/body/form";

        $data = [
            'reservation' => $reservation->data, 
            'action' => '/admin/reservations/update',
            'locations' => $locations
        ];
    elseif($method == 'create'):
        if(redirectIfTotalEqualsZero('Src\Models\Location', '/admin/locations', 'Para adicionar uma reserva, primeiro adicione um local!')) die;

        $location = new Location();

        $locations = getArraySelect($location->where('status', '=', 'on')->get(['id', 'name']), 'id', 'name');
        $background = 'bg-primary';
        $text  = 'Adicionar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/reservations/create', 'locations' => $locations];
    endif;

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => $background,
        'type' => $text,
        'icon' => 'bi bi-calendar-event-fill',
        'title' => 'Reservas',
        'route_delete' => $method == 'read' ? '/admin/reservations/delete' : null,
        'route_add' => $method == 'create' ? null : '/admin/reservations?method=create',
        'route_search' => '/admin/reservations',
        'plugins' => ['select2'],
        'body' => $body,
        'data' => $data,
    ]);

    function loadInFooter(): void
    { 
        loadHtml(__DIR__.'/../../resources/admin/partials/modal-delete'); ?>
        
        <script type="text/javascript" src="<?php asset('libs/jquery/jquery.mask.min.js?ver='.APP_VERSION)?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/HoursAvailable.js') ?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/Clients.js') ?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/UpdateReservation.js') ?>"></script>
        <script type="text/javascript">
            Clients.init('#identifier', '/api/clients', 'CPF / CNPJ / Identificador do cliente');

            $('#phone').mask('(00) 00000-0000');

            UpdateReservation.payment()
                .status()
                .openModal();

            const hoursAvailable = new HoursAvailable();
            hoursAvailable.getHours()
                .changeLocation()
                .changeDate()
                .changePeiod()
                .changeDay()
                .changeType()
                .changeIsPartner()
                .submited();
        </script>
    <?php }
