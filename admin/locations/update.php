<?php
    verifyMethod(500, 'POST');

    use Src\Models\Location;
    $location = new Location();

    $requests = requests();

    $status = empty($requests->status) ? 'off' : $requests->status;
    $images = isset($requests->images) ? $requests->images : null;
    $prices = array_map(function($value) {
        return ($value === "") ? '0.00' : str_replace(',', '.', $value);
    }, $requests->prices);

    $location->find($requests->id)->update([
        'name' => $requests->name,
        'start_hour' => $requests->start_hour,
        'end_hour' => $requests->end_hour,
        'opening' => $requests->opening,
        'status' => $status,
        'category_id' => $requests->category_id,
        'type' => $requests->type,
        'prices' => json_encode(array_combine(pickDaysOfTheWeek(), $prices)),
        'opening_days' => json_encode($requests->opening_days)
    ]);

    $location->images()->sync($images);

    session([
        'message' => 'Local editado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/locations', true), true, 302);
