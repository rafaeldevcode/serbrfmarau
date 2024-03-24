<?php
    verifyMethod(500, 'POST');

    use Src\Models\Payment;
    use Src\Models\Protocol;
    use Src\Models\Reservation;
    use Src\Models\Time;

    $time = new Time();
    $protocol = new Protocol();
    $reservation = new Reservation();
    $payment = new Payment();
    $requests = requests();

    foreach($requests->ids as $ID):
        $reservation = $reservation->find($ID);
        
        foreach($reservation->protocols()->data as $item):
            $protocol->find($item->id)->delete();
        endforeach;

        foreach($reservation->schedules()->data as $item):
            $time->find($item->id)->delete();
        endforeach;

        foreach($reservation->payments()->data as $item):
            $payment->find($item->id)->delete();
        endforeach;

        $reservation->delete();
    endforeach;

    session([
        'message' => 'Reserva(s) removida(s) com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/reservations', true), true, 302);
