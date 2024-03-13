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
    $reservation = $reservation->find($requests->id);
    $title = 'Status do horário atualizado!';
    $current_status = $reservation->data->status;

    $reservation->update([
        'name' => $requests->name,
        'email' => $requests->email,
        'phone' => $requests->phone,
        'identifier' => $requests->identifier,
        'type' => isset($requests->type) ? $requests->type : 'Normal',
        'payment_type' => $requests->payment_type,
        'amount_people' => empty($requests->amount_people) ? 0 : $requests->amount_people,
        'event' => $requests->event,
        'period' => isset($requests->period) ? $requests->period : null,
        'location_id' => $requests->location_id,
        'observation' => $requests->observation,
        'status' => $requests->status,
        'date' => empty($requests->day) ? $requests->date : null,
        'day' => ! empty($requests->day) ? $requests->day : date('l', strtotime($requests->date))
    ]);

    if($requests->hours):
        $schedules->where('reservation_id', '=', $requests->id)->delete();
    
        if($requests->status !== 'Cancelado'):
            foreach ($requests->hours as $hour) :
                $schedules->create([
                    'date' => empty($requests->day) ? $requests->date : null,
                    'day' => ! empty($requests->day) ? $requests->day : date('l', strtotime($requests->date)),
                    'hour' => $hour,
                    'status' => $requests->status,
                    'reservation_id' => $requests->id,
                    'location_id' => $requests->location_id
                ]);
            endforeach;
        endif;
    endif;

    if ($current_status !== $requests->status):
        $protocol = $protocol->find($reservation->protocols()->data[0]->id);
        $protocol->update([
            'reservation_status' => $requests->status
        ]);

        foreach($reservation->schedules()->data as $item):
            $schedules->find($item->id)->update(['status' => $requests->status]);
        endforeach;

        if(!empty($requests->email)):
            $email = new EmailServices(BodyEmail::protocol($requests->status, $protocol->data->token, $title, 'update'), $title, $requests->email);
            $email->send();
        endif;
    endif;

    session([
        'message' => 'Reserva editada com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/reservations', true), true, 302);
