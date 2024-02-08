<div data-modal="hours" class="z-[99999] fixed top-0 left-0 w-full h-full items-center justify-center hidden z-50">
    <div class="bg-white rounded w-full max-w-[500px]" data-modal-body="popup">
        <div class="p-4 relative bg-color-main rounded-t">
            <button data-modal-close="popup" type="button" title="Fechar modal" class="absolute top-0 right-2 text-white hover:text-gray-800 w-[20px] opacity-50">
                <i class="bi bi-x text-2xl"></i>
            </button>

            <h2 class="font-bold text-white p-2 rounded text-center">Selecionar horários</h2>
        </div>

        <div class="p-4">
            <section class="border border-secondary p-4 rounded shadow-md">
                <h3 class="text-secondary"><strong>Local:</strong> <span id="location"></span></h3>
                <h3 class="text-secondary"><strong>Valor:</strong> <span id="total-value"></span></h3>

                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/form/input-default', [
                        'icon' => 'bi bi-calendar-event-fill',
                        'name' => 'date',
                        'label' => 'Data',
                        'type' => 'date',
                        'value' => isset($event) ? $event->date : date('Y-m-d')
                    ]) ?>
                </div>

                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'period',
                        'label' => 'Período (Somente se for período interiro)',
                        'value' => isset($event) ? $event->period : null,
                        'attributes' => [
                            'data-change' => 'selects'
                        ],
                        'array' => [
                            '' => '----Selecione----',
                            'Manhã' => 'Manhã',
                            'Tarde' => 'Tarde',
                            'Noite' => 'Noite'
                        ]
                    ]) ?>
                </div>

                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'day',
                        'label' => 'Dia da semana',
                        'value' => isset($event) ? $event->day : null,
                        'attributes' => [
                            'data-change' => 'selects'
                        ],
                        'array' => [
                            '' => '----Selecione----',
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

                <div class="relative w-full h-[300px] overflow-y-auto">
                    <?php loadHtml(__DIR__.'/preloader', ['position' => 'absolute', 'type' => 'hours']) ?>

                    <div class="flex justify-center items-center flex-wrap gap-1 max-w-[150px] mx-auto" data-list="hours"></div>
                </div>
            </section>

            <div class="flex justify-end space-x-2 mt-4">
                <button data-modal-close="popup" type="button" class="btn btn-color-main font-bold">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
