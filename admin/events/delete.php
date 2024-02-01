<?php
    verifyMethod(500, 'POST');

    use Src\Models\Event;

    $event = new Event();
    $requests = requests();

    foreach($requests->ids as $ID):
        $event->find($ID)->delete();
    endforeach;

    session([
        'message' => 'Evento(s) removido(s) com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/events', true), true, 302);
