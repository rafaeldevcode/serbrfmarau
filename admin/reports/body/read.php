<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <section>
        <form action="" method="POST" class="flex flex-col items-end">
            <div class='w-full flex flex-wrap items-end'>
                <div class="w-full md:w-4/12 lg:w-3/12 px-1">
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'date',
                        'label' => 'Data da reserva',
                        'value' => isset(requests()->date) ? requests()->date : null,
                        'array' => [
                            '' => '----',
                            'P1D' => 'Hoje',
                            'P1W' => 'Essa semana',
                            'P1M' => 'Esse mês',
                            'P1Y' => 'Esse ano'
                        ]
                    ]) ?>
                </div>

                <div class="w-full md:w-4/12 lg:w-3/12 px-1">
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'location',
                        'label' => 'Local',
                        'value' => isset(requests()->location) ? requests()->location : null,
                        'array' => [...[ '' => '----' ], ...$locations]
                    ]) ?>
                </div>

                <div class="w-full md:w-4/12 lg:w-6/12 flex justify-end gap-2">
                    <button data-form-submit="pdf" title="Filtrar" class="btn btn-color-main font-bold my-3">
                        Gerar PDF
                    </button>

                    <button data-form-submit="search" title="Filtrar" class="btn btn-color-main font-bold my-3">
                        Buscar
                    </button>
                </div>
            </div>
        </form>

        <div>
            <div class="relative overflow-x-auto max-w-[2000px] mx-auto mb-4 rounded border p-4">
                <table class="w-full md:w-5/12 text-xs text-left">
                    <thead class="text-white uppercase bg-color-main">
                        <tr>
                            <th scope="col" class="p-2">
                                Local
                            </th>
                            <th scope="col" class="p-2">
                                Responssável
                            </th>
                            <th scope="col" class="p-2 text-right">
                                Total de Reservas
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reservations_by_location as $reservation): ?>
                            <tr class="bg-white border-b hover:bg-gray-100 text-gray-900">
                                <td scope="row" class="p-2 whitespace-nowrap">
                                    <?php echo $reservation['location'] ?>
                                </td>
                                <td scope="row" class="p-2 whitespace-nowrap">
                                    <?php echo $reservation['responsible'] ?>
                                </td>
                                <td scope="row" class="p-2 whitespace-nowrap text-right">
                                    <?php echo $reservation['total_reservation'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="relative overflow-x-auto max-w-[2000px] mx-auto mb-4 rounded border p-4">
                <table class="w-full text-xs text-left">
                    <thead class="text-white uppercase bg-color-main">
                        <tr>
                            <th scope="col" class="p-2">
                                Data
                            </th>
                            <th scope="col" class="p-2">
                                Horários
                            </th>
                            <th scope="col" class="p-2">
                                Nome
                            </th>
                            <th scope="col" class="p-2">
                                Local
                            </th>
                            <th scope="col" class="p-2 text-right">
                                Valor
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reservations->data as $reservation): ?>
                            <tr class="bg-white border-b hover:bg-gray-100 text-gray-900">
                                <td scope="row" class="p-2 whitespace-nowrap">
                                    <?php echo $reservation->type == 'Fixo' ? translateDayWeek($reservation->day) : date('d/m/Y', strtotime($reservation->date)) ?>
                                </td>
                                <td scope="row" class="p-2 whitespace-nowrap">
                                    <?php echo getBtweenHours($reservation->id, $reservation->location_id, $reservation->period) ?>
                                </td>
                                <td scope="row" class="p-2 whitespace-nowrap">
                                    <?php echo $reservation->name ?>
                                </td>
                                <td scope="row" class="p-2 whitespace-nowrap">
                                    <?php echo getLocationName($reservation->location_id) ?>
                                </td>
                                <td scope="row" class="p-2 whitespace-nowrap text-right">
                                    <?php echo getPriceOfTheReservation($reservation->id) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if(count($reservations->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>
    </section>
</section>
