<?php
    verifyMethod(500, 'POST');

    use Src\Models\Location;
    use Src\Models\LocationImages;

    $images = new LocationImages();
    $location = new Location();
    $requests = requests();
    $message = 'Local(is) removido(s) com sucesso!';
    $type = 'success';

    foreach($requests->ids as $ID):
        $location->find($ID);

        if(!empty($location->reservations()->data)):
            $message = 'Locais que possuem reservas registradas, não podem ser removidos!';
            $type = 'info';
        else:
            $location->delete();
            $images->where('location_id', '=', $ID)->delete();
        endif;
    endforeach;

    session([
        'message' => $message,
        'type' => $type
    ]);

    return header(route('/admin/locations', true), true, 302);
