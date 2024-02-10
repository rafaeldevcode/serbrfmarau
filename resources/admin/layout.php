<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['google_analytics']) ? loadHtml(__DIR__.'/../partials/google-analytics', ['header' => true, 'pixel' => SETTINGS['google_analytics']]) : ''; ?>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['facebook_pixel']) ? loadHtml(__DIR__.'/../partials/facebook-pixel', ['header' => true, 'pixel' => SETTINGS['facebook_pixel']]) : ''; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='<?php asset('libs/bootstrap-icons/bootstrap-icons.min.css?ver='.APP_VERSION) ?>' />

    <?php if(isset($plugins) && in_array('tinymce', $plugins)): ?>
        <!-- Tinymce start -->
        <script type="text/javascript" src="<?php asset('libs/tinymce/tinymce.js?ver='.APP_VERSION) ?>"></script>
        <link rel='stylesheet' href='<?php asset('libs/tinymce/skins/ui/oxide/skin.min.css?ver='.APP_VERSION) ?>' />
        <link rel='stylesheet' href='<?php asset('libs/tinymce/skins/ui/oxide/content.min.css?ver='.APP_VERSION) ?>' />
        <link rel='stylesheet' href='<?php asset('libs/tinymce/skins/content/default/content.css?ver='.APP_VERSION) ?>' />
        <!-- Tinymce end -->
    <?php endif ?>

    <?php if(isset($plugins) && in_array('select2', $plugins)): ?>
        <link href="<?php asset('libs/select2/select2.min.css?ver='.APP_VERSION)?>" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php endif ?>

    <link rel='stylesheet' href='<?php asset('libs/tailwind/admin/style.css?ver='.APP_VERSION) ?>' />
    <link rel='stylesheet' href='<?php asset('assets/css/globals.css?ver='.APP_VERSION) ?>' />
    
    <link rel="shortcut icon" href="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_favicon']) ? asset('assets/images/'.SETTINGS['site_favicon'].'') : asset('assets/images/favicon.svg') ?>" alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>">

    <meta name='author' content='Rafael Vieira | github.com/rafaeldevcode' />
    <meta name="description" content="<?php echo !is_null(SETTINGS) ? SETTINGS['site_description'] : '' ?>">

    <title><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?> | <?php echo $title ?></title>
</head>
<body>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['facebook_pixel']) ? loadHtml(__DIR__.'/../partials/facebook-pixel', ['header' => false, 'pixel' => SETTINGS['facebook_pixel']]) : ''; ?>

    <section class='flex flex-nowrap justify-between w-full'>
        <?php loadHtml(__DIR__.'/partials/sidebar') ?>

        <section class='w-full'>
            <?php loadHtml(__DIR__.'/partials/header') ?>

            <?php loadHtml(__DIR__.'/partials/breadcrumps', [
                'background' => $background,
                'type' => $type,
                'icon' => $icon,
                'title' => $title,
                'route_delete' => isset($route_delete) ? $route_delete : null,
                'route_add' => isset($route_add) ? $route_add : null,
                'route_search' => isset($route_search) ? $route_search : null,
            ]) ?>

            <?php loadHtml($body, isset($data) ? $data : []) ?>
        </section>
    </section>

    <!-- Include footer -->
    <?php loadHtml(__DIR__.'/partials/footer') ?>

    <!-- Include flash message -->
    <?php loadHtml(__DIR__.'/../partials/message') ?>

    <!-- Include Preloader -->
    <?php !is_null(SETTINGS) && SETTINGS['preloader'] == 'on' && loadHtml(__DIR__.'/../partials/preloader', ['position' => 'fixed', 'type' => 'body']) ?>

    <script type="text/javascript" src="<?php asset('libs/jquery/jquery.js?ver='.APP_VERSION)?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/main.js?ver='.APP_VERSION) ?>"></script>

    <script type="text/javascript" src="<?php asset('assets/scripts/class/Modal.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Cookies.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/PageBack.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Preloader.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Menu.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Message.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Password.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/ValidateForm.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Remove.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript">
        Menu.checkIsOpen();
        Menu.admin($('#checkbox-menu'));
        Message.hide('[data-message]');
        Password.show('[data-id-pass]');

        // Validate the form
        const validate = new ValidateForm();
        validate.init();

        // Delete item(s)
        const remove = new Remove();
        remove.init();

        PageBack.init();

        document.addEventListener("DOMContentLoaded", () => {
            Preloader.hide('body');
        });

        Modal.init();
    </script>

    <?php if(isset($plugins) && in_array('tinymce', $plugins)): ?>
        <!-- Tinymce start -->
        <script type="text/javascript" src="<?php asset('libs/tinymce/themes/silver/theme.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/models/dom/model.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/icons/default/icons.js?ver='.APP_VERSION) ?>"></script>

        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/image/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/codesample/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/emoticons/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/emoticons/js/emojis.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/charmap/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/autolink/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/anchor/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/wordcount/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/visualblocks/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/table/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/searchreplace/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/media/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/lists/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/link/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <script type="text/javascript" src="<?php asset('libs/tinymce/plugins/code/plugin.min.js?ver='.APP_VERSION) ?>"></script>
        <!-- Tinymce end -->
    <?php endif ?>

    <?php if(isset($plugins) && in_array('select2', $plugins)): ?>
        <script type="text/javascript" src="<?php asset('libs/select2/select2.full.min.js?ver='.APP_VERSION)?>"></script>
    <?php endif ?>

    <?php if(function_exists('loadInFooter')) loadInFooter(); ?>
</body>
</html>
