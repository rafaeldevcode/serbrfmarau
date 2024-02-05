<?php
    verifyMethod(500, 'POST');

    use Src\Models\Event;
    use Src\Models\Time;

    $requests = requests();

    $schedules = new Time();
    $event = new Event();

    $event = $event->create([
        'name' => $requests->name,
        'type' => $requests->type,
        'payment_type' => $requests->payment_type,
        'amount_people' => $requests->amount_people,
        'event' => $requests->event,
        'period' => $requests->period,
        'location_id' => $requests->location_id,
        'client_id' => $requests->client_id,
        'observation' => $requests->observation,
        'status' => $requests->status,
        'date' => empty($requests->day) ? $requests->date : null,
        'day' => ! empty($requests->day) ? $requests->day : null
    ]);

    foreach ($requests->hours as $hour) :
        $schedules->create([
            'date' => empty($requests->day) ? $requests->date : null,
            'day' => ! empty($requests->day) ? $requests->day : null,
            'hour' => $hour,
            'event_id' => $event->id,
            'location_id' => $requests->location_id
        ]);
    endforeach;

    session([
        'message' => 'Evento adicionado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/events', true), true, 302);
