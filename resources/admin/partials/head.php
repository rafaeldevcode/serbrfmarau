<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['google_analytics']) ? loadHtml(__DIR__.'/../../partials/google-analytics', ['header' => true, 'pixel' => SETTINGS['google_analytics']]) : ''; ?>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['facebook_pixel']) ? loadHtml(__DIR__.'/../../partials/facebook-pixel', ['header' => true, 'pixel' => SETTINGS['facebook_pixel']]) : ''; ?>

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
    <?php !is_null(SETTINGS) && !empty(SETTINGS['facebook_pixel']) ? loadHtml(__DIR__.'/../../partials/facebook-pixel', ['header' => false, 'pixel' => SETTINGS['facebook_pixel']]) : ''; ?>
