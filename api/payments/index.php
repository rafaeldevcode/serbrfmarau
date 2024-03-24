<?php

    use Src\Models\Reservation;

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'POST'):
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    else:
        $requests = requests();
        $reservation = new Reservation();
        $reservation = $reservation->find($requests->id);
        $payments = $reservation->payments()->data;

        $data = ['success' => true, 'data' => $payments];
    endif;

    echo json_encode($data);
