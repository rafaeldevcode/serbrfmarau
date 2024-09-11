<?php

    use Src\Models\Location;
    use Src\Models\Reservation;

    $reservation = new Reservation();
    $location = new Location();

    $reservations = filterReservationsReports($reservation);
    $locations = $location->get();

    $reservationsByLocation = reservationsByLocations($locations);

    $locations = getArraySelect($locations, 'id', 'name');

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => 'bg-secondary',
        'type' => 'Visualizar',
        'icon' => 'bi bi-file-text-fill',
        'title' => 'Reservas',
        'plugins' => ['select2'],
        'body' => __DIR__."/body/read",
        'data' => [
            'locations' => $locations,
            'reservations' => $reservations,
            'reservations_by_location' => $reservationsByLocation
        ],
    ]);

    function loadInFooter(): void
    { 
        loadHtml(__DIR__.'/../../resources/admin/partials/modal-delete'); ?>
        
        <script type="text/javascript" src="<?php asset('assets/scripts/class/HoursAvailable.js') ?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/Clients.js') ?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/UpdateReservation.js') ?>"></script>
        <script type="text/javascript">
            Clients.init('#identifier', '/api/clients', 'CPF / CNPJ / Identificador do cliente');

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

            $('button[data-form-submit]').on('click', (event) => {
                event.preventDefault();
                const button = $(event.target);
                const form = button.parent().parent().parent();

                if (button.attr('data-form-submit') === 'pdf') {
                    form.attr('method', 'GET');
                    form.attr('target', '_blank');
                    form.attr('action', '/admin/reports/generate-pdf');
                    form.submit();
                } else if(button.attr('data-form-submit') === 'search') {
                    form.attr('method', 'POST');
                    form.removeAttr('target');
                    form.attr('action', '');
                    form.submit();
                }
            });
        </script>
    <?php }
