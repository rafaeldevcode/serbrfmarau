<?php
    verifyMethod(500, 'POST');

    use Src\Models\Event;

    $requests = requests();

    $event = new Event();

    $event->create([
        'name' => $requests->name,
        'type' => $requests->type,
        'payment_type' => $requests->payment_type,
        'amount_people' => $requests->amount_people,
        'event' => $requests->event,
        'period' => $requests->period,
        'location_id' => $requests->location_id,
        'client_id' => $requests->client_id,
        'observation' => $requests->observation,
        'status' => 'Solicitado'
    ]);

    session([
        'message' => 'Evento adicionado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/events', true), true, 302);
