<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['google_analytics']) ? loadHtml(__DIR__.'/../partials/google-analytics', ['header' => true, 'pixel' => SETTINGS['google_analytics']]) : ''; ?>
    <?php !is_null(SETTINGS) && !empty(SETTINGS['facebook_pixel']) ? loadHtml(__DIR__.'/../partials/facebook-pixel', ['header' => true, 'pixel' => SETTINGS['facebook_pixel']]) : ''; ?>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if(isset($plugins) && in_array('slick', $plugins)): ?>
        <link rel='stylesheet' href='<?php asset('libs/slick/slick.css?ver='.APP_VERSION) ?>' />
        <link rel='stylesheet' href='<?php asset('libs/slick/slick-theme.css?ver='.APP_VERSION) ?>' />
    <?php endif ?>

    <link rel='stylesheet' href='<?php asset('libs/bootstrap-icons/bootstrap-icons.min.css?ver='.APP_VERSION) ?>' />
    <link rel='stylesheet' href='<?php asset('libs/tailwind/client/style.css?ver='.APP_VERSION) ?>' />
    <link rel='stylesheet' href='<?php asset('assets/css/globals.css?ver='.APP_VERSION) ?>' />

    <link rel="shortcut icon" href="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_favicon']) ? asset('assets/images/'.SETTINGS['site_favicon'].'') : asset('assets/images/favicon.svg') ?>" alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>">

    <meta name='author' content='Rafael Vieira | github.com/rafaeldevcode' />
    <meta name="description" content="<?php echo !is_null(SETTINGS) ? SETTINGS['site_description'] : '' ?>">

    <title><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?> | <?php echo $title ?></title>
</head>
<body>
    <!-- Include Header -->
    <?php loadHtml(__DIR__ . '/partials/header.php') ?>

    <main>
        <?php loadHtml($body, $data)?>
    </main>

    <!-- Include Footer -->
    <?php loadHtml(__DIR__ . '/partials/footer.php') ?>

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
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Message.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/ValidateForm.js?ver='.APP_VERSION) ?>"></script>

    <?php if(isset($plugins) && in_array('slick', $plugins)): ?>
        <script type="text/javascript" src="<?php asset('libs/slick/slick.min.js?ver='.APP_VERSION)?>"></script>
    <?php endif ?>
    
    <script type="text/javascript">
        Message.hide('[data-message]');

        // Validate the form
        const validate = new ValidateForm();
        validate.init();

        document.addEventListener("DOMContentLoaded", () => {
            Preloader.hide('body');
        });

        Modal.init();

        // Open and closed menu client
        const button = $('#button-menu-client');
        button.on('click', (event) => {
            const menu = $('#menu-client');

            if(button.attr('data-menu') == 'close'){
                menu.removeClass('hidden');

                button.attr('data-menu', 'open');
            } else {
                menu.addClass('hidden');

                button.attr('data-menu', 'close');
            }
        });
    </script>

    <?php if(function_exists('loadInFooter')) loadInFooter(); ?>
</body>
</html>
