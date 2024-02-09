<?php
    use Src\Models\Category;

    $method = empty(querys('method')) ? 'read' : querys('method');

    if($method == 'read'):
        $category = new Category();
        $requests = requests();
        $categories = !isset($requests->search) ? $category->paginate(20) : $category->where('name', 'LIKE', "%{$requests->search}%")->paginate(20);
        $background = 'bg-secondary';
        $text  = 'Visualizar';
        $body = __DIR__."/body/read";

        $data = ['categories' => $categories];
    elseif($method == 'edit'):
        $category = new Category();
        $category = $category->find(querys('id'));
        $background = 'bg-success';
        $text  = 'Editar';
        $body = __DIR__."/body/form";

        $data = ['category' => $category->data, 'action' => '/admin/categories/update'];
    elseif($method == 'create'):
        $background = 'bg-primary';
        $text  = 'Adicionar';
        $body = __DIR__."/body/form";

        $data = ['action' => '/admin/categories/create'];
    endif;

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => $background,
        'type' => $text,
        'icon' => 'bi bi-bookmarks-fill',
        'title' => 'Categorias',
        'route_delete' => $method == 'read' ? '/admin/categories/delete' : null,
        'route_add' => $method == 'create' ? null : '/admin/categories?method=create',
        'route_search' => '/admin/categories',
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
            gallery.openModalSelect($('[data-upload=thumbnail]'), 'radio');
        </script>

    <?php }
