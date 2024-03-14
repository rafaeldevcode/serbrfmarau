<?php

    use Src\Models\Reservation;
    use Src\Models\Protocol;

    $hash = slug(3);
    $protocol = new Protocol();

    $protocol = $protocol->where('token', '=', $hash)->first();

    if(! $protocol) abort(404, 'Protocol not found!', 'danger');

    $reservation = new Reservation();

    $reservation = $reservation->find($protocol->reservation_id);
    $location = $reservation->location();
    $schedules = $reservation->schedules()->data;
    $total_schedules = is_null($schedules) ? 0 : count($schedules);

    loadHtml(__DIR__.'/body/read', [
        'image' => !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? 'assets/images/'.SETTINGS['site_bg_login'] : 'assets/images/login_bg.jpg',
        'reservation' => $reservation?->data,
        'location' => $location?->data[0],
        'protocol' => $protocol,
        'total_schedules' => $total_schedules
    ]);
