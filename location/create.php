<?php
    verifyMethod(500, 'POST');

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Reservation;
    use Src\Models\Protocol;
    use Src\Models\Time;

    $schedules = new Time();
    $reservation = new Reservation();
    $protocol = new Protocol();

    $requests = requests();

    // Create reservation
    if($requests->create_type == 'schedule'):
        $title = 'Horário reservado!';
        $status = 'Pendente';

        $reservation = $reservation->create([
            'name' => $requests->name,
            'email' => $requests->email,
            'phone' => $requests->phone,
            'identifier' => $requests->identifier,
            'type' => 'Normal',
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
                'status' => $status,
                'reservation_id' => $reservation->id,
                'location_id' => $requests->location_id
            ]);
        endforeach;

        $protocol = $protocol->create([
            'reservation_id' => $reservation->id,
            'reservation_status' => $status,
            'token' => $protocol->generateToken()
        ]);

        $email = new EmailServices(BodyEmail::protocol($status, $protocol->token, $title, 'create'), $title, $requests->email);
        $email->send();

        session([
            'message' => 'Reserva adicionada com sucesso!',
            'type' => 'success'
        ]);

        return header(route("/reservations/protocols?protocol={$protocol->token}", true), true, 302);
        die;
    endif;

    return header(route("/", true), true, 302);
