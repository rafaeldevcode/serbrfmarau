<?php
    verifyMethod(500, 'POST');

    use Src\Models\Location;
    $location = new Location();

    $requests = requests();

    $status = empty($requests->status) ? 'off' : $requests->status;
    $images = isset($requests->images) ? $requests->images : null;

    $location->find($requests->id)->update([
        'name' => $requests->name,
        'start_hour' => $requests->start_hour,
        'end_hour' => $requests->end_hour,
        'opening' => $requests->opening,
        'status' => $status,
        'category_id' => $requests->category_id,
        'type' => $requests->type,
        'description' => $requests->description,
        'prices' => json_encode(mountPrices($requests->prices, $requests->prices_partners)),
        'opening_days' => json_encode($requests->opening_days),
        'email' => $requests->email
    ]);

    $location->images()->sync($images);

    session([
        'message' => 'Local editado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/locations', true), true, 302);
