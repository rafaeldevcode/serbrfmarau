<?php
    verifyMethod(500, 'POST');

    use Src\Models\Gallery;
    use Src\Models\Location;

    $requests = requests();
    $location = new Location();
    $gallery = new Gallery();

    $status = isset($requests->status) ? $requests->status : 'off';
    $images = isset($requests->images) ? $requests->images : null;

    $new_location = $location->create([
        'name' => $requests->name,
        'start_hour' => $requests->start_hour,
        'end_hour' => $requests->end_hour,
        'opening' => $requests->opening,
        'status' => $status,
        'user_id' => $_SESSION['user_id'],
        'category_id' => $requests->category_id,
        'type' => $requests->type,
        'description' => $requests->description,
        'prices' => json_encode(mountPrices($requests->prices, $requests->prices_partners)),
        'opening_days' => json_encode($requests->opening_days),
        'email' => $requests->email
    ]);

    $location->find($new_location->id)->images()->sync($images);

    session([
        'message' => 'Local adicionado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/locations', true), true, 302);
