<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <section>
        <div class='flex flex-col items-end'>
            <a target="_blank" class="mr-2 text-color-main" href="<?php route('/reservation/protocol') ?>">Buscar usando protocolo</a>

            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'button',
                'style' => 'color-main',
                'title' => 'Filtrar',
                'value' => 'Filtrar',
                'attributes' => [
                    'data-toggle' => 'filter',
            ]])?>
        </div>

        <div class="relative overflow-x-auto max-w-[2000px] mx-auto mb-4 rounded border">
            <table class="w-full text-xs text-left">
                <thead class="text-white uppercase bg-color-main">
                    <tr>
                        <th scope="col" class="p-2">
                            <div class="flex items-center">
                                <input 
                                    data-button="select-several"
                                    id="checkbox-all-search" 
                                    type="checkbox" 
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                >
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="p-2">
                            Data
                        </th>
                        <th scope="col" class="p-2">
                            Horários
                        </th>
                        <th scope="col" class="p-2">
                            Protocolo
                        </th>
                        <th scope="col" class="p-2">
                            Nome
                        </th>
                        <th scope="col" class="p-2">
                            Tipo
                        </th>
                        <th scope="col" class="p-2">
                            Evento
                        </th>
                        <th scope="col" class="p-2">
                            Quant.
                        </th>
                        <th scope="col" class="p-2">
                            Pagamento
                        </th>
                        <th scope="col" class="p-2">
                            Pago
                        </th>
                        <th scope="col" class="p-2">
                            Local
                        </th>
                        <th scope="col" class="p-2">
                            Status
                        </th>
                        <th scope="col" class="p-2 text-right">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations->data as $reservation): ?>
                        <tr class="bg-white border-b hover:bg-gray-100 text-gray-900">
                            <td class="w-4 p-2">
                                <div class="flex items-center">
                                    <input 
                                        value='<?php echo $reservation->id ?>' 
                                        data-message-delete='Esta ação irá remover todas as reservas selecionados!'
                                        type='checkbox'
                                        data-button="delete-enable"
                                        id="checkbox-table-search-<?php echo $reservation->id ?>" 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    >
                                    <label for="checkbox-table-search-<?php echo $reservation->id ?>" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $reservation->type == 'Fixo' ? translateDayWeek($reservation->day) : date('d/m/Y', strtotime($reservation->date)) ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo getBtweenHours($reservation->id, $reservation->location_id, $reservation->period) ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo getProtocol($reservation->id) ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $reservation->name ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $reservation->type ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $reservation->event ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $reservation->amount_people ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $reservation->payment_type ?>
                            </td>
                            <td scope="row" class="p-2">
                                <span class="flex items-center">
                                    <?php if($reservation->type === 'Normal'): ?>
                                        <!-- <span data-status="<?php echo $reservation->payment ?>" class="rounded text-xs text-light px-2 py-1 bg-<?php echo (is_null($reservation->status) || $reservation->payment == 'off') ? 'danger' : 'primary' ?>">
                                            <?php echo (is_null($reservation->payment) || $reservation->payment == 'off') ? 'Não' : 'Sim' ?>
                                        </span> -->

                                        <?php 
                                        $payments = getPaymentIds($reservation->id);

                                        loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                                            'name' => 'payment',
                                            'label' => '',
                                            'value' => array_values($payments)[0],
                                            'attributes' => [
                                                'data-reservation-payment' => array_keys($payments)[0]
                                            ]
                                        ]) ?>
                                    <?php else: ?>
                                        <button
                                            data-reservation="<?php echo $reservation->id ?>"
                                            type='button'
                                            title='Pagamentos'
                                            class='p-2 text-xs rounded btn-danger text-light fw-bold'
                                        >
                                            Pagamentos
                                        </button>
                                    <?php endif ?>
                                </span>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo getLocationName($reservation->location_id) ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                                    'name' => 'status',
                                    'value' => $reservation->status,
                                    'attributes' => [
                                        'data-reservation-status' => $reservation->id
                                    ],
                                    'array' => [
                                        'Pendente' => 'Pendente',
                                        'Aprovado' => 'Aprovado',
                                        'Reprovado' => 'Reprovado',
                                        'Finalizado' => 'Finalizado'
                                    ]
                                ]) ?>
                            </td>
                            <td class="flex items-center justify-end p-2 space-x-2 right">
                                <a href="<?php route("/admin/reservations/?method=edit&id={$reservation->id}") ?>" title='Editar reserva <?php echo $reservation->name ?>' class='text-xs p-2 rounded btn-primary text-light fw-bold'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>

                                <button
                                    data-button="delete"
                                    data-route='<?php route('/admin/reservations/delete') ?>'
                                    data-delete-id='<?php echo $reservation->id ?>'
                                    data-message-delete='Esta ação irá remover a reserva "<?php echo $reservation->name ?>"!'
                                    type='button'
                                    title='Remover reserva <?php echo $reservation->name ?>'
                                    class='p-2 text-xs rounded btn-danger text-light fw-bold'
                                >
                                    <i class='bi bi-trash-fill'></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if(count($reservations->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>
    </section>

    <?php if(isset($reservations->page)):
        loadHtml(__DIR__.'/../../../resources/admin/partials/pagination', [
            'page' => $reservations->page,
            'count' => $reservations->count,
            'next' => $reservations->next,
            'prev' => $reservations->prev,
            'search' => $reservations->search
        ]);
    endif; ?>

    <?php 
        loadHtml(__DIR__.'/partials/filter');
        loadHtml(__DIR__.'/partials/payments')
    ?>
</section>
