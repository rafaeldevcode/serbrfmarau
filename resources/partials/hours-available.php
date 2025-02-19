<?php
    use Src\Models\Location;
    $location = new Location();
    $location = isset($location_id) ? $location->find($location_id)?->data : null;

    if (isset($location_id) && $location->allow_all_day_only === 'on') {
        $periods = [
            '' => '----Selecione----',
            'Dia todo' => 'Dia todo'
        ];
    } else {
        $periods = [
            '' => '----Selecione----',
            'Dia todo' => 'Dia todo',
            'Manhã' => 'Manhã',
            // 'Tarde' => 'Tarde',
            'Noite' => 'Noite'
        ];
    }
?>

<div class="mt-12">
    <h2 class="font-bold text-xl text-secondary">Horários disponiveis</h2>

    <form method="POST" action="<?php route($route) ?>" id="submit-reservation">
        <?php if(isset($reservation)): ?>
            <input type="hidden" name="id" id="reservation_id" value="<?php echo $reservation->id ?>">
        <?php endif ?>

        <?php if(! $is_admin): ?>
            <input type="hidden" name="location_id" id="location_id" value="<?php echo $location_id ?>">
        <?php endif ?>

        <input type="hidden" name="is_admin" id="is_admin" value="<?php echo $is_admin ? 'on' : 'off' ?>">

        <div class='w-full md:w-6/12 px-4 mt-6'>
            <?php loadHtml(__DIR__.'/form/input-checkbox-switch', [
                'name' => 'is_partner',
                'label' => 'Sócio? (Não | Sim)',
                'value' => isset($reservation) ? $reservation->is_partner : null
            ]) ?>
        </div>
        <div class="flex flex-wrap w-full border-b border-secondary pb-2">
            <div class='w-full md:w-3/12 px-2'>
                <?php loadHtml(__DIR__.'/form/input-default', [
                    'icon' => 'bi bi-calendar-event-fill',
                    'name' => 'date',
                    'label' => 'Data',
                    'type' => 'date',
                    'value' => isset($reservation, $reservation->date) ? $reservation->date : date('Y-m-d')
                ]) ?>
            </div>

            <div class='w-full md:w-3/12 px-2'>
                <?php loadHtml(__DIR__.'/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'day',
                    'label' => 'Dia da semana',
                    'value' => isset($reservation) ? $reservation->day : null,
                    'attributes' => [
                        'data-change' => 'selects'
                    ],
                    'array' => [
                        'Sunday' => 'Domingo',
                        'Monday' => 'Segunda',
                        'Tuesday' => 'Terça',
                        'Wednesday' => 'Quarta',
                        'Thursday' => 'Quinta',
                        'Friday' => 'Sexta',
                        'Saturday' => 'Sábado'
                    ]
                ]) ?>
            </div>

            <?php if($is_admin): ?>
                <div class='w-full md:w-3/12 px-2'>
                    <?php loadHtml(__DIR__.'/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'location_id',
                        'label' => 'Local',
                        'value' => isset($reservation) ? $reservation->location_id : null,
                        'attributes' => 'required',
                        'array' => $locations,
                        'attributes' => [
                            'data-change' => 'locations'
                        ]
                    ]) ?>
                </div>

                <div class='w-full md:w-3/12 px-2'>
                    <?php loadHtml(__DIR__.'/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'type',
                        'label' => 'Tipo',
                        'value' => isset($reservation) ? $reservation->type : null,
                        'attributes' => 'required',
                        'array' => [
                            'Normal' => 'Normal',
                            'Fixo' => 'Fixo'
                        ]
                    ]) ?>
                </div>
            <?php endif ?>

            <div class='w-full md:w-3/12 px-2'>
                <?php loadHtml(__DIR__.'/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'period',
                    'label' => 'Período (Somente se for período interiro)',
                    'value' => isset($reservation) ? $reservation->period : null,
                    'attributes' => [
                        'data-change' => 'selects',
                        'required' => true
                    ],
                    'array' => $periods,
                ]) ?>
            </div>
        </div>

        <div class="relative w-full min-h-[200px] overflow-y-auto">
            <?php loadHtml(__DIR__.'/preloader', ['position' => 'absolute', 'type' => 'hours']) ?>

            <table class="w-full text-xs text-left">
                <tbody data-list="hours"></tbody>
            </table>
        </div>

        <div id="schedule" class="hidden fixed w-full left-0 bottom-0 px-2 py-3 bg-white border-t border-color-main justify-center flex-col items-center">
            <p class="text-color-main">
                <b>Valor total:</b> <span id="total-value"></span>
            </p>

            <p class="mb-2 text-color-main font-bold" id="warning"></p>

            <button type="button" disabled title="Prosseguir" class="btn btn-color-main mx-2" data-toggle="reservation">Continuar</button>
        </div>

        <?php loadHtml(__DIR__.'/modal-reservation', [
            'is_admin' => $is_admin,
            'reservation' => isset($reservation) ? $reservation : null
        ]) ?>
    </form>
</div>
