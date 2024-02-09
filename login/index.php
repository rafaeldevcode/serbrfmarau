<?php 
    require __DIR__ .'/../bootstrap/bootstrap.php';

    if(autenticate(false)) return header(route('/admin/dashboard', true), true, 302);
?>

<!DOCTYPE html>
<html lang="pt-BR" class="h-full w-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='<?php asset('libs/tailwind/admin/style.css?ver='.APP_VERSION) ?>' />
    <link rel='stylesheet' href='<?php asset('libs/bootstrap-icons/bootstrap-icons.min.css?ver='.APP_VERSION) ?>' />
    <link rel='stylesheet' href='<?php asset('assets/css/globals.css?ver='.APP_VERSION) ?>' />
    <meta name='author' content='Rafael Vieira | github.com/rafaeldevcode' />
    <link rel="shortcut icon" href="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_favicon']) ? asset('assets/images/'.SETTINGS['site_favicon'].'') : asset('assets/images/favicon.svg') ?>" alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>">

    <title><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?> | Login</title>
</head>
<body class="h-full w-full">

    <?php loadHtml(__DIR__.'/../resources/partials/message') ?>

    <main class="h-full w-full flex flex-nowrap">
        <div class='w-7/12 relative section-image-login'>
            <div class='absolute top-0 left-0 image-bg-login' style="background-image: url(<?php !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? asset('assets/images/'.SETTINGS['site_bg_login'].'') : asset('assets/images/login_bg.jpg') ?>)"></div>

            <div class='absolute bottom-0 left-0 m-2 flex flex-nowrap'>
                <div class='me-3'>
                    <i class='bi bi-gear-fill text-7xl text-color-main'></i>
                </div>

                <div>
                    <h1 class='m-0 text-4xl text-color-main font-bold'><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?></h1>
                    <p class='m-0 text-xl text-color-main font-bold'><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_description']) ? SETTINGS['site_description'] : 'Realize seu login!' ?></p>
                </div>
            </div>
        </div>

        <div class='flex flex-col justify-center items-center w-full lg:w-5/12 p-2'>
            <div class='w-full sm:w-6/12 md:w-7/12 mb-5'>
                <img class='w-full' src="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_logo_main']) ? asset('assets/images/'.SETTINGS['site_logo_main'].'') : asset('assets/images/logo_main.svg') ?>" alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>" />
            </div>

            <form class='w-full sm:w-6/12 md:w-7/12' method="POST" action="<?php route('/login/create') ?>">
                <!-- Input email -->
                <div class="mt-6">
                    <?php loadHtml(__DIR__.'/../resources/partials/form/input-default', [
                        'icon' => 'bi bi-envelope-fill',
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <!-- Input pass -->
                <div class="mt-6">
                    <?php loadHtml(__DIR__.'/../resources/partials/form/input-default', [
                        'icon' => 'bi bi-key-fill',
                        'name' => 'password',
                        'label' => 'Senha',
                        'type' => 'password',
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <!-- Input button -->
                <div class="flex justify-end">
                    <?php loadHtml(__DIR__.'/../resources/partials/form/input-button', [
                        'type' => 'submit',
                        'style' => 'color-main',
                        'title' => 'Realizar login',
                        'value' => 'Logar'
                    ]) ?>
                </div>
            </form>
        </div>
    </main>

    <script type="text/javascript" src="<?php asset('libs/jquery/jquery.js?ver='.APP_VERSION)?>"></script>
    <script type="text/javascript" src="<?php asset('libs/bootstrap/bootstrap.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Message.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Password.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/ValidateForm.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript">
        Message.hide('[data-message]');
        Password.show('[data-id-pass]');

        // Validate the form
        const validate = new ValidateForm();
        validate.init();
    </script>
</body>
</html>
