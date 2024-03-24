<?php

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;
    use Src\Models\Location;
    use Src\Models\Payment;
    use Src\Models\Protocol;
    use Src\Models\Reservation;
    use Src\Models\Time;

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    else:
        $requests = requests();

        if($requests->type === 'status'):
            $reservation = new Reservation();
            $reservation = $reservation->find($requests->id);
    
            $reservation->update(['status' => $requests->status]);
    
            $data = ['success' => true, 'message' => 'Status alterado com sucesso', 'data' => ['status' => $requests->status]];

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
        elseif($requests->type === 'payment'):
            $payment = new Payment();
            $payment = $payment->find((int)$requests->id);
    
            $payment->update(['status' => $requests->payment]);
    
            $data = ['success' => true, 'message' => 'Status de pagamento alterado com sucesso', 'data' => ['payment' => $requests->payment]];
        endif;
    endif;

    echo json_encode($data);
