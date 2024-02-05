<?php
    verifyMethod(500, 'POST');

    use Src\Models\Event;
    use Src\Models\Time;

    $schedules = new Time();
    $event = new Event();
    $requests = requests();
    $event = $event->find($requests->id);

    $event->update([
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

    if($requests->hours):
        $schedules->where('event_id', '=', $requests->id)->delete();
    
        foreach ($requests->hours as $hour) :
            $schedules->create([
                'date' => empty($requests->day) ? $requests->date : null,
                'day' => ! empty($requests->day) ? $requests->day : null,
                'hour' => $hour,
                'event_id' => $requests->id,
                'location_id' => $requests->location_id
            ]);
        endforeach;
    endif;

    session([
        'message' => 'Evento editado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/events', true), true, 302);
