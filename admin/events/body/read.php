<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <section>
        <form action="" class="w-full flex justify-end" id="change-status" method="POST">
            <div class='w-full md:w-4/12'>
                <?php if(isset(requests()->search)): ?>
                    <input type="hidden" name="search" value="<?php echo requests()->search ?>">
                <?php endif ?>

                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'status',
                    'label' => 'Status',
                    'value' => isset(requests()->status) ? requests()->status : null,
                    'attributes' => [
                        'data-change' => 'status',
                    ],
                    'array' => [
                        'Pendente' => 'Pendente',
                        'Aprovado' => 'Aprovado',
                        'Reprovado' => 'Reprovado'
                    ]
                ]) ?>
            </div>
        </form>

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
                            Nome
                        </th>
                        <th scope="col" class="p-2">
                            Tipo
                        </th>
                        <th scope="col" class="p-2">
                            Evento
                        </th>
                        <th scope="col" class="p-2">
                            Quantidade de pessoas
                        </th>
                        <th scope="col" class="p-2">
                            Pagamento
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
                    <?php foreach($events->data as $event): ?>
                        <tr class="bg-white border-b hover:bg-gray-100 text-gray-900">
                            <td class="w-4 p-2">
                                <div class="flex items-center">
                                    <input 
                                        value='<?php echo $event->id ?>' 
                                        data-message-delete='Esta ação irá remover todos os evento selecionados!'
                                        type='checkbox'
                                        data-button="delete-enable"
                                        id="checkbox-table-search-<?php echo $event->id ?>" 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    >
                                    <label for="checkbox-table-search-<?php echo $event->id ?>" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $event->name ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $event->type ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $event->event ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $event->amount_people ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $event->payment_type ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <span class="rounded text-xs text-light px-2 py-1 bg-<?php echo getBadgeEventStatus($event->status) ?>">
                                    <?php echo $event->status ?>
                                </span>
                            </td>
                            <td class="flex items-center justify-end p-2 space-x-2 right">
                                <a href="<?php route("/admin/events/?method=edit&id={$event->id}") ?>" title='Editar evento <?php echo $event->name ?>' class='text-xs p-2 rounded btn-primary text-light fw-bold'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>

                                <button
                                    data-button="delete"
                                    data-route='<?php route('/admin/events/delete') ?>'
                                    data-delete-id='<?php echo $event->id ?>'
                                    data-message-delete='Esta ação irá remover o evento "<?php echo $event->name ?>"!'
                                    type='button'
                                    title='Remover evento <?php echo $event->name ?>'
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

        <?php if(count($events->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>
    </section>

    <?php if(isset($events->page)):
        loadHtml(__DIR__.'/../../../resources/admin/partials/pagination', [
            'page' => $events->page,
            'count' => $events->count,
            'next' => $events->next,
            'prev' => $events->prev,
            'search' => $events->search
        ]);
    endif; ?>
</section>
