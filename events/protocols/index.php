<?php

    use Src\Models\Event;
    use Src\Models\Protocol;

    $hash = requests()?->protocol;
    $protocol = new Protocol();

    $protocol = $protocol->where('token', '=', $hash)->first();

    if(! $protocol) abort(404, 'Protocol not found!', 'danger');

    $event = new Event();

    $event = $event->find($protocol->event_id);
    $location = $event->location();
    $schedules = $event->schedules();
    $total_schedules = count($schedules->data);

    loadHtml(__DIR__.'/body/read', [
        'image' => !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? 'assets/images/'.SETTINGS['site_bg_login'] : 'assets/images/login_bg.jpg',
        'event' => $event?->data,
        'location' => $location?->data[0],
        'schedules' => $schedules?->data,
        'protocol' => $protocol,
        'total_schedules' => $total_schedules
    ]);
