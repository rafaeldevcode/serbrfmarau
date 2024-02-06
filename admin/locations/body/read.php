<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <section>
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
                            Hora Inicial
                        </th>
                        <th scope="col" class="p-2">
                            Hora Final
                        </th>
                        <th scope="col" class="p-2">
                            Abertura
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
                    <?php foreach($locations->data as $location): ?>
                        <tr class="bg-white border-b hover:bg-gray-100 text-gray-900">
                            <td class="w-4 p-2">
                                <div class="flex items-center">
                                    <input 
                                        value='<?php echo $location->id ?>' 
                                        data-message-delete='Esta ação irá remover todos os locais selecionados!'
                                        type='checkbox'
                                        data-button="delete-enable"
                                        id="checkbox-table-search-<?php echo $location->id ?>" 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    >
                                    <label for="checkbox-table-search-<?php echo $location->id ?>" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $location->name ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $location->start_hour ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $location->end_hour ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $location->opening ?>
                            </td>
                            <td class="p-2">
                                <span class="rounded text-xs text-light px-2 py-1 bg-<?php echo (is_null($location->status) || $location->status == 'off') ? 'danger' : 'primary' ?>">
                                    <?php echo (is_null($location->status) || $location->status == 'off') ? 'Inativo' : 'Ativo' ?>
                                </span>
                            </td>
                            <td class="flex items-center justify-end p-2 space-x-2 right">
                                <a href="<?php route("/admin/locations/?method=edit&id={$location->id}") ?>" title='Editar local <?php echo $location->name ?>' class='text-xs p-2 rounded btn-primary text-light fw-bold'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>

                                <button
                                    data-button="delete"
                                    data-route='<?php route('/admin/locations/delete') ?>'
                                    data-delete-id='<?php echo $location->id ?>'
                                    data-message-delete='Esta ação irá remover o local "<?php echo $location->name ?>"!'
                                    type='button'
                                    title='Remover local <?php echo $location->name ?>'
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

        <?php if(count($locations->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>
    </section>

    <?php if(isset($locations->page)):
        loadHtml(__DIR__.'/../../../resources/admin/partials/pagination', [
            'page' => $locations->page,
            'count' => $locations->count,
            'next' => $locations->next,
            'prev' => $locations->prev,
            'search' => $locations->search
        ]);
    endif; ?>
</section>
