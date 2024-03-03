<?php
    verifyMethod(500, 'POST');

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Event;
    use Src\Models\Protocol;
    use Src\Models\Time;

    $schedules = new Time();
    $event = new Event();
    $protocol = new Protocol();

    $requests = requests();
    $event = $event->find($requests->id);
    $title = 'Status do horário atulalizado!';
    $current_status = $event->data->status;

    $event->update([
        'name' => $requests->name,
        'type' => $requests->type,
        'payment_type' => $requests->payment_type,
        'amount_people' => $requests->amount_people,
        'event' => $requests->event,
        'period' => $requests->period,
        'location_id' => $requests->location_id,
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

    if ($current_status !== $requests->status):
        $protocol = $protocol->find($event->protocols()->data[0]->id);
        $protocol->update([
            'event_status' => $requests->status
        ]);

        $email = new EmailServices(BodyEmail::protocol($requests->status, $protocol->data->token, $title, 'update'), $title);
        $email->send();
    endif;

    session([
        'message' => 'Evento editado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/events', true), true, 302);
