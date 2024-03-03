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

    // Create Event
    if($requests->create_type == 'schedule'):
        $title = 'Horário reservado!';
        $status = 'Pendente';

        $event = $event->create([
            'name' => $requests->name,
            'type' => $requests->type,
            'payment_type' => $requests->payment_type,
            'amount_people' => $requests->amount_people,
            'event' => $requests->event,
            'period' => $requests->period,
            'location_id' => $requests->location_id,
            'observation' => $requests->observation,
            'status' => $status,
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

        $protocol = $protocol->create([
            'event_id' => $event->id,
            'event_status' => $status,
            'token' => $protocol->generateToken()
        ]);

        $email = new EmailServices(BodyEmail::protocol($status, $protocol->token, $title, 'create'), $title);
        $email->send();

        session([
            'message' => 'Evento adicionado com sucesso!',
            'type' => 'success'
        ]);

        return header(route("/events/protocols?protocol={$protocol->token}", true), true, 302);
        die;
    endif;

    return header(route("/", true), true, 302);
