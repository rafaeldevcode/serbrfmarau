<?php
    require __DIR__ .'/../../bootstrap/bootstrap.php';

    use Src\Models\Location;

    header('Content-Type: application/json');

    if($_SERVER['REQUEST_METHOD'] == 'GET'):
        $requests = requests();

        $locacation = new Location();
        $locacation = $locacation->find($requests->id);

        if($locacation->data):
            $data = [
                'success' => true,
                'message' => 'Local encontrado!',
                'data' => [
                    'id' => $locacation->data->id,
                    'type' => $locacation->data->type,
                    'start_hour' => $locacation->data->start_hour,
                    'end_hour' => $locacation->data->end_hour,
                    'allow_all_day_only' => $locacation->data->allow_all_day_only,
                ]
            ];
        else:
            $data = [
                'success' => false,
                'message' => 'Local não encontrado!',
                'data' => []
            ];
        endif;
    else:
        $data = ['success' => false, 'message' => 'Method Not Allowed'];
    endif;

    echo json_encode($data);
