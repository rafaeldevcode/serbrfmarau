<?php 
    use Src\Models\Setting;

    $settings = new Setting();
    $settings = $settings->first();

    loadHtml(__DIR__.'/../../resources/admin/layout', [
        'background' => 'bg-success',
        'type' => 'Editar',
        'icon' => 'bi bi-gear-fill',
        'title' => 'Configurações',
        'body' => __DIR__."/body/form",
        'data' => ['settings' => $settings],
    ]);

    function loadInFooter(): void
    {
        loadHtml(__DIR__.'/../../resources/admin/partials/gallery') ?>

        <script type="text/javascript" src="<?php asset('libs/jquery/jquery.mask.min.js?ver='.APP_VERSION)?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/Gallery.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/ChangeLocationMaps.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript">
            $('#phone').mask('+00 (00) 0 0000-0000');
            $('#whatsapp').mask('+00 (00) 0 0000-0000');
    
            const gallery = new Gallery();
    
            gallery.openModalSelect($('[data-upload=site_logo_main]'), 'radio');
            gallery.openModalSelect($('[data-upload=site_logo_secondary]'), 'radio');
            gallery.openModalSelect($('[data-upload=site_favicon]'), 'radio');
            gallery.openModalSelect($('[data-upload=site_bg_login]'), 'radio');
        </script>
    <?php }
