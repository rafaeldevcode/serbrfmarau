<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <section>
        <div class="relative overflow-x-auto max-w-[2000px] mx-auto mb-4 rounded border">
            <table class="w-full text-xs text-left text-gray-500">
                <thead class="text-gray-700 uppercase bg-color-main">
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
                            ID
                        </th>
                        <th scope="col" class="p-2">
                            Nome
                        </th>
                        <th scope="col" class="p-2">
                            Telefone
                        </th>
                        <th scope="col" class="p-2">
                            Tipo
                        </th>
                        <th scope="col" class="p-2">
                            Identificador
                        </th>
                        <th scope="col" class="p-2 text-right">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clients->data as $client): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="w-4 p-2">
                                <div class="flex items-center">
                                    <input 
                                        value='<?php echo $client->id ?>' 
                                        data-message-delete='Esta ação irá remover todos os clientes selecionados!'
                                        type='checkbox'
                                        data-button="delete-enable"
                                        id="checkbox-table-search-<?php echo $client->id ?>" 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    >
                                    <label for="checkbox-table-search-<?php echo $client->id ?>" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="p-2 font-medium text-gray-900 whitespace-nowrap">
                                <?php echo $client->id ?>
                            </td>
                            <td scope="row" class="p-2 text-gray-900 whitespace-nowrap">
                                <?php echo $client->name ?>
                            </td>
                            <td scope="row" class="p-2 text-gray-900 whitespace-nowrap">
                                <?php echo $client->phone ?>
                            </td>
                            <td scope="row" class="p-2 text-gray-900 whitespace-nowrap">
                                <?php echo $client->type ?>
                            </td>
                            <td scope="row" class="p-2 text-gray-900 whitespace-nowrap">
                                <?php echo $client->identifier ?>
                            </td>
                            <td class="flex items-center justify-end p-2 space-x-2 right">
                                <a href="<?php route("/admin/clients/?method=edit&id={$client->id}") ?>" title='Editar cliente <?php echo $client->title ?>' class='text-xs p-2 rounded btn-primary text-light fw-bold'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>

                                <button
                                    data-button="delete"
                                    data-route='<?php route('/admin/clients/delete') ?>'
                                    data-delete-id='<?php echo $client->id ?>'
                                    data-message-delete='Esta ação irá remover o cliente "<?php echo $client->name ?>"!'
                                    type='button'
                                    title='Remover cliente <?php echo $client->title ?>'
                                    class='p-2 rounded btn-danger text-light fw-bold'
                                >
                                    <i class='bi bi-trash-fill'></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


        <?php if(count($clients->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>
    </section>

    <?php if(isset($clients->page)):
        loadHtml(__DIR__.'/../../../resources/admin/partials/pagination', [
            'page'   => $clients->page,
            'count'  => $clients->count,
            'next'   => $clients->next,
            'prev'   => $clients->prev,
            'search' => $clients->search
        ]);
    endif; ?>
</section>
