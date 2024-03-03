<?php
    require __DIR__ .'/../../bootstrap/bootstrap.php';

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
        $requests = requests();
        $data = getHoursReservation($requests->location_id, $requests->date, $requests->reservation_id, $requests->day);
    else:
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    endif;

    echo json_encode($data);
