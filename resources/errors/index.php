<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='<?php asset('libs/tailwind/admin/style.css?ver='.APP_VERSION) ?>' />
        <link rel='stylesheet' href='<?php asset('libs/bootstrap-icons/bootstrap-icons.min.css?ver='.APP_VERSION) ?>' />
        <link rel='stylesheet' href='<?php asset('assets/css/globals.css?ver='.APP_VERSION) ?>' />
        <meta name='author' content='Rafael Vieira | github.com/rafaeldevcode' />
        <link rel="shortcut icon" href="<?php asset('assets/images/favicon.svg') ?>" type="image/pnh">

        <title><?php echo $title ?></title>
    </head>

    <body class="antialiased">
        <main class='w-screen h-screen flex justify-center items-center custom-<?php echo $error ?>'>
            <div class='container flex flex-col justify-center items-center border rounded border-<?php echo $type ?> m-2 custom-<?php echo $error ?>-mirror'>
                <ul class='flex text-secondary flex-nowrap text-<?php echo $type ?> list-unstyled'>
                    <li class='font-bold text-4xl'><?php echo $error ?></li>
                    <li class='text-4xl mx-4'>|</li>
                    <li class='text-4xl'><?php echo $message ?></li>
                </ul>

                <button id='back' class='mt-4 btn btn-<?php echo $type ?> text-light'>Voltar</button>
            </div>
        </main>
    </body>
    
    <script type="text/javascript" src="<?php asset('libs/jquery/jquery.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/class/PageBack.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript">
        PageBack.init();
    </script>
</html>
