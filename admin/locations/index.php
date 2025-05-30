<?php

    use Src\Models\Gallery;
    use Src\Models\Category;
    use Src\Models\Location;

    $method = empty(querys('method')) ? 'read' : querys('method');

    if($method == 'read'):
        $location = new Location();
        $requests = requests();
        $locations = !isset($requests->search) ? $location->paginate(20) : $location->where('name', 'LIKE', "%{$requests->search}%")->paginate(20);
        $background = 'bg-secondary';
        $text  = 'Visualizar';
        $body = __DIR__."/body/read";

        $data = ['locations' => $locations];
    elseif($method == 'edit'):
        $galery = new Gallery();
        $category = new Category();
        $location = new Location();
        $location = $location->find(querys('id'));
        $categories = getArraySelect($category->where('type', '=', 'Locais')->get(['id', 'name']), 'id', 'name');

        $background = 'bg-success';
        $text  = 'Editar';
        $body = __DIR__."/body/form";

        $data = [
            'location' => $location->data, 
            'action' => '/admin/locations/update', 
            'categories' => $categories,
            'images' => $location->images()->data
        ];
    elseif($method == 'create'):
        if(redirectIfTotalEqualsZero('Src\Models\Category', '/admin/categories', 'Para adicionar um local, primeiro adicione uma categoria!')) die;
 
        $category = new Category();
        $categories = getArraySelect($category->where('type', '=', 'Locais')->get(['id', 'name']), 'id', 'name');

        $background = 'bg-primary';
        $text  = 'Adicionar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/locations/create', 'categories' => $categories];
    endif;

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => $background,
        'type' => $text,
        'icon' => 'bi bi-map-fill',
        'title' => 'Locais',
        'route_delete' => $method == 'read' ? '/admin/locations/delete' : null,
        'route_add' => $method == 'create' ? null : '/admin/locations?method=create',
        'route_search' => '/admin/locations',
        'body' => $body,
        'data' => $data,
        'plugins' => ['select2']
    ]);

    function loadInFooter(): void
    {
        loadHtml(__DIR__.'/../../resources/admin/partials/gallery');
        loadHtml(__DIR__.'/../../resources/admin/partials/modal-delete') ?>

        <script type="text/javascript" src="<?php asset('assets/scripts/class/Gallery.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/NormalizeHour.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript">
            const gallery = new Gallery();
            gallery.openModalSelect($('[data-upload=images]'), 'checkbox');

            NormalizeHour.init();

            $('[name="opening_days[]"]').select2({placeholder: '----Selecione----'});

            toggleButton($('[name=type]').val());

            $('[name=type]').on('change', (event) => {
                toggleButton($(event.target).val());
            });

            function toggleButton(value){
                const button = $('[data-toggle=prices-day]');

                if (value === 'period') {
                    button.show();
                } else {
                    button.hide();
                }
            }

            // $('#save-location').on('submit', (event) => {
            //     let valid = false;

            //     $('[name="prices[]"]').each((key, input) => {
            //         if(input.value.length > 0){
            //             valid = true;
            //             return;
            //         }
            //     });

            //     if(!valid){
            //         event.preventDefault();

            //         Message.create('É necessário preencher os preços dos horário/período!', 'danger');
            //         Modal.open('prices');
            //     }
            // });
        </script>
    <?php }
