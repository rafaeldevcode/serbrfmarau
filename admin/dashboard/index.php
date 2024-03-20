<?php

    use Src\Models\Location;
    use Src\Models\Reservation;

    $reservations = new Reservation();
    $date = date('Y-m-d');
    $day = date('l', strtotime($date));
    $locations = new Location();
    $location_reservations = [];

    $today_reservations = $reservations->where('status', '=', 'Aprovado')->where('day', '=', $day)->get();
    $today_reservations = array_filter($today_reservations, function ($item) use($date) {
        return !is_null($item->date) || $item->date === $date;
    });

    $locations = $locations->where('status', '=', 'on')->get();

    foreach ($locations as $location) {
        $reservations = new Reservation();
        $reservations_count = $reservations->where('status', '=', 'Aprovado')->where('location_id', '=', $location->id)->count();

        array_push($location_reservations, ['location' => $location->name, 'count' => $reservations_count]);
    }

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => 'bg-secondary',
        'type' => 'Visualizar',
        'icon' => 'bi bi-speedometer',
        'title' => 'Dashboard',
        'data' => ['today_reservations' => count($today_reservations), 'location_reservations' => $location_reservations],
        'body' => __DIR__."/body/read"
    ]);
