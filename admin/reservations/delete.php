<?php
    verifyMethod(500, 'POST');

    use Src\Models\Reservation;

    $reservation = new Reservation();
    $requests = requests();

    foreach($requests->ids as $ID):
        $reservation->find($ID)->delete();
    endforeach;

    session([
        'message' => 'Reserva(s) removida(s) com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/reservations', true), true, 302);
