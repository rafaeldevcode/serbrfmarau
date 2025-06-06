<?php
    verifyMethod(500, 'POST');

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Client;
    use Src\Models\Location;
    use Src\Models\Payment;
    use Src\Models\Protocol;
    use Src\Models\Reservation;
    use Src\Models\Time;

    $schedules = new Time();
    $reservation = new Reservation();
    $protocol = new Protocol();
    $client = new Client();
    $location = new Location();
    $payment = new Payment();

    $requests = requests();
    $identifier = isset($requests->identifier) ? $requests->identifier : null;
    $client = isset($identifier) ? $client->where('cpf_cnpj', '=', $identifier)->first() : null;
    $location = $location->find($requests->location_id);
    $isPartner = isset($requests->is_partner) ? $requests->is_partner : 'off';

    $title = 'Reserva Iniciada!';
    $payments = generatePayments(isset($requests->type) ? $requests->type : null, isset($requests->date) ? $requests->date : null);

    $reservation = $reservation->create([
        'name' => $requests->name,
        'email' => $requests->email,
        'phone' => preg_replace('/[^0-9]/', '', $requests->phone),
        'identifier' => $identifier,
        'type' => isset($requests->type) ? $requests->type : 'Normal',
        'payment_type' => $requests->payment_type,
        'amount_people' => empty($requests->amount_people) ? 0 : $requests->amount_people,
        'event' => $requests->event,
        'period' => isset($requests->period) ? $requests->period : null,
        'location_id' => $requests->location_id,
        'observation' => $requests->observation,
        'status' => $requests->status,
        'is_partner' => $isPartner,
        'date' => empty($requests->day) ? $requests->date : null,
        'day' => ! empty($requests->day) ? $requests->day : date('l', strtotime($requests->date)),
        'observation_payment' => $requests->observation_payment
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
        'token' => $protocol->generateToken($reservation->id)
    ]);

    if (isset($identifier) && ! empty($identifier)):
        if ($client) {
            $new_client = new Client();
            $new_client->find($client->id)->update([
                'email' => $requests->email,
                'phone' => preg_replace('/[^0-9]/', '', $requests->phone),
                'cpf_cnpj' => $identifier,
                'payment_type' => $requests->payment_type,
                'amount_people' =>  empty($requests->amount_people) ? 0 : $requests->amount_people,
                'event' => $requests->event
            ]);
        } else {
            $client = new Client();
            $client->create([
                'email' => $requests->email,
                'phone' => preg_replace('/[^0-9]/', '', $requests->phone),
                'cpf_cnpj' => $identifier,
                'payment_type' => $requests->payment_type,
                'amount_people' =>  empty($requests->amount_people) ? 0 : $requests->amount_people,
                'event' => $requests->event
            ]);
        }
    endif;

    foreach($payments as $token):
        $payment->create([
            'token' => $token,
            'status' => isset($requests->payment) ? $requests->payment : 'off',
            'reservation_id' => $reservation->id
        ]);
    endforeach;

    $email = new EmailServices(BodyEmail::protocol($requests->status, $protocol->token, $title, 'create'), $title);
    $email->setEmailTo($location->data->email);
    if(!empty($requests->email)) $email->setEmailTo($requests->email);
    $email->send();

    session([
        'message' => 'Reserva Realizada com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/reservations', true), true, 302);
