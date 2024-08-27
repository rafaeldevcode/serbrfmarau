<?php
    require __DIR__ .'/../../bootstrap/bootstrap.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
        $requests = requests();
        $reservation_id = isset($requests->reservation_id) ? $requests->reservation_id : null;
        $day = isset($requests->day) ? $requests->day : null;

        $data = getHoursReservation($requests->location_id, $requests->date, $reservation_id, $day, $requests->block_previous, $requests->period ?? null);
    else:
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    endif;

    echo json_encode($data);
