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
                            Título
                        </th>
                        <th scope="col" class="p-2">
                            Link
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
                    <?php foreach($banners->data as $banner): ?>
                        <tr class="bg-white border-b hover:bg-gray-100 text-gray-900">
                            <td class="w-4 p-2">
                                <div class="flex items-center">
                                    <input 
                                        value='<?php echo $banner->id ?>' 
                                        data-message-delete='Esta ação irá remover todos os baners selecionados!'
                                        type='checkbox'
                                        data-button="delete-enable"
                                        id="checkbox-table-search-<?php echo $banner->id ?>" 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    >
                                    <label for="checkbox-table-search-<?php echo $banner->id ?>" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $banner->title ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <?php echo $banner->link ?>
                            </td>
                            <td scope="row" class="p-2 whitespace-nowrap">
                                <span class="rounded text-xs text-light px-2 py-1 bg-<?php echo (is_null($banner->status) || $banner->status == 'off') ? 'danger' : 'primary' ?>">
                                    <?php echo (is_null($banner->status) || $banner->status == 'off') ? 'Inativo' : 'Ativo' ?>
                                </span>
                            </td>
                            <td class="flex items-center justify-end p-2 space-x-2 right">
                                <a href="<?php route("/admin/banners/?method=edit&id={$banner->id}") ?>" title='Editar banner <?php echo $banner->title ?>' class='text-xs p-2 rounded btn-primary text-light fw-bold'>
                                    <i class='bi bi-pencil-square'></i>
                                </a>

                                <button
                                    data-button="delete"
                                    data-route='<?php route('/admin/banners/delete') ?>'
                                    data-delete-id='<?php echo $banner->id ?>'
                                    data-message-delete='Esta ação irá remover o banner "<?php echo $banner->title ?>"!'
                                    type='button'
                                    title='Remover banner <?php echo $banner->title ?>'
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

        <?php if(count($banners->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>
    </section>

    <?php if(isset($banners->page)):
        loadHtml(__DIR__.'/../../../resources/admin/partials/pagination', [
            'page' => $banners->page,
            'count' => $banners->count,
            'next' => $banners->next,
            'prev' => $banners->prev,
            'search' => $banners->search
        ]);
    endif; ?>
</section>
