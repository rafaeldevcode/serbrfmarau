<?php
    use Src\Models\Banners;

    $method = empty(querys('method')) ? 'read' : querys('method');

    if($method == 'read'):
        $banner = new Banners();
        $requests = requests();
        $banners = !isset($requests->search) ? $banner->paginate(20) : $banner->where('name', 'LIKE', "%{$requests->search}%")->paginate(20);
        $background = 'bg-secondary';
        $text  = 'Visualizar';
        $body = __DIR__."/body/read";

        $data = ['banners' => $banners];
    elseif($method == 'edit'):
        $banner = new Banners();
        $banner = $banner->find(querys('id'));
        $background = 'bg-success';
        $text  = 'Editar';
        $body = __DIR__."/body/form";

        $data = ['banner' => $banner->data, 'action' => '/admin/banners/update'];
    elseif($method == 'create'):
        $background = 'bg-primary';
        $text  = 'Adicionar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/banners/create'];
    endif;

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => $background,
        'type' => $text,
        'icon' => 'bi bi-images',
        'title' => 'Banners',
        'route_delete' => $method == 'read' ? '/admin/banners/delete' : null,
        'route_add' => $method == 'create' ? null : '/admin/banners?method=create',
        'route_search' => '/admin/banners',
        'body' => $body,
        'data' => $data,
    ]);

    function loadInFooter(): void
    { 
        loadHtml(__DIR__.'/../../resources/admin/partials/gallery');
        loadHtml(__DIR__.'/../../resources/admin/partials/modal-delete'); ?>
        
        <script type="text/javascript" src="<?php asset('assets/scripts/class/Gallery.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript">
            const gallery = new Gallery();
            gallery.openModalSelect($('[data-upload=desktop]'), 'radio');
            gallery.openModalSelect($('[data-upload=mobile]'), 'radio');
        </script>

    <?php }
