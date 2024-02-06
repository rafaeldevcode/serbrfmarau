<?php
    verifyMethod(500, 'POST');

    use Src\Models\Location;
    use Src\Models\LocationImages;

    $images = new LocationImages();
    $location = new Location();
    $requests = requests();

    foreach($requests->ids as $ID):
        $location->find($ID)->delete();
        $images->where('location_id', '=', $ID)->delete();;
    endforeach;

    session([
        'message' => 'Local(is) removido(s) com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/locations', true), true, 302);
