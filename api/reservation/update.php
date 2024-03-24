<?php

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Location;
    use Src\Models\Protocol;
    use Src\Models\Reservation;
    use Src\Models\Time;

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    else:
        $requests = requests();
        $reservation = new Reservation();
        $reservation = $reservation->find($requests->id);

        $data = $requests->type === 'payment' ? ['payment' => $requests->payment] : ['status' => $requests->status];

        $reservation->update($data);

        $data = ['success' => true, 'message' => 'Status alterado com sucesso', 'data' => $data];

        if($requests->type === 'status'):
            $protocol = new Protocol();
            $schedules = new Time();
            $location = new Location();
            $location = $location->find($reservation->data->location_id);

            $title = 'Status do horário atualizado!';
            $protocol = $protocol->find($reservation->protocols()->data[0]->id);
            $protocol->update([
                'reservation_status' => $requests->status
            ]);
    
            foreach($reservation->schedules()->data as $item):
                $schedules->find($item->id)->update(['status' => $requests->status]);
            endforeach;
    
            $email = new EmailServices(BodyEmail::protocol($requests->status, $protocol->data->token, $title, 'update'), $title);
            if(!empty($reservation->data->email)) $email->setEmailTo($reservation->data->email);
            $email->setEmailTo($location->data->email);
            $email->send();
        endif;
    endif;

    echo json_encode($data);
