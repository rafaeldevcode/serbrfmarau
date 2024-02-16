<?php
    verifyMethod(500, 'POST');

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Client;
    use Src\Models\Event;
    use Src\Models\Protocol;
    use Src\Models\Time;

    $schedules = new Time();
    $event = new Event();
    $client = new Client();
    $protocol = new Protocol();

    $requests = requests();

    // Create Client
    if($requests->create_type == 'client'):
        $data = [
            'name' => $requests->name,
            'email' => $requests->email,
            'phone' => preg_replace('/[^0-9]/', '', $requests->phone),
            'cpf' => preg_replace('/[^0-9]/', '', $requests->cpf),
            'city' => $requests->city,
            'street' => $requests->street,
            'neighborhood' => $requests->neighborhood,
            'street_number' => $requests->street_number,
            'type' => $requests->type,
            'identifier' => generateIdentifier(20)
        ];
    
        $client->create($data);
    
        return header(route("/location?location={$requests->location_id}&email={$requests->email}", true), true, 302);
        die;
    endif;

    // Create Event
    if($requests->create_type == 'schedule'):
        $client = $client->find($requests->client_id);
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
            'client_id' => $requests->client_id,
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
            'client_id' => $client->data->id,
            'event_id' => $event->id,
            'event_status' => $status,
            'token' => $protocol->generateToken()
        ]);

        $email = new EmailServices(BodyEmail::protocol($client->data->name, $status, $protocol->token, $title, 'create'), $title, $client->data->email);
        $email->send();

        session([
            'message' => 'Evento adicionado com sucesso!',
            'type' => 'success'
        ]);

        return header(route("/events/protocols?protocol={$protocol->token}", true), true, 302);
        die;
    endif;

    return header(route("/", true), true, 302);
