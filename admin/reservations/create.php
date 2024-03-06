<?php
    verifyMethod(500, 'POST');

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Protocol;
    use Src\Models\Reservation;
    use Src\Models\Time;

    $requests = requests();

    $schedules = new Time();
    $reservation = new Reservation();
    $protocol = new Protocol();

    $title = 'Horário reservado!';

    $reservation = $reservation->create([
        'name' => $requests->name,
        'email' => $requests->email,
        'phone' => $requests->phone,
        'identifier' => $requests->identifier,
        'type' => isset($requests->type) ? $requests->type : 'Normal',
        'payment_type' => $requests->payment_type,
        'amount_people' => empty($requests->amount_people) ? 0 : $requests->amount_people,
        'event' => $requests->event,
        'period' => $requests->period,
        'location_id' => $requests->location_id,
        'observation' => $requests->observation,
        'status' => $requests->status,
        'date' => empty($requests->day) ? $requests->date : null,
        'day' => ! empty($requests->day) ? $requests->day : date('l', strtotime($requests->date))
    ]);

    foreach ($requests->hours as $hour) :
        $schedules->create([
            'date' => empty($requests->day) ? $requests->date : null,
            'day' => ! empty($requests->day) ? $requests->day : date('l', strtotime($requests->date)),
            'hour' => $hour,
            'status' => $requests->status,
            'reservation_id' => $reservation->id,
            'location_id' => $requests->location_id
        ]);
    endforeach;

    $protocol = $protocol->create([
        'reservation_id' => $reservation->id,
        'reservation_status' => $requests->status,
        'token' => "P000{$reservation->id}"
    ]);

    if(!empty($requests->email)):
        $email = new EmailServices(BodyEmail::protocol($requests->status, $protocol->token, $title, 'create'), $title, $requests->email);
        $email->send();
    endif;

    session([
        'message' => 'Reserva Realizada com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/reservations', true), true, 302);
