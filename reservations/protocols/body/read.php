<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='<?php asset('libs/tailwind/client/style.css') ?>' />
    <link rel='stylesheet' href='<?php asset('libs/bootstrap-icons/bootstrap-icons.min.css') ?>' />
    <link rel='stylesheet' href='<?php asset('assets/css/globals.css') ?>' />
    <meta name='author' content='Rafael Vieira | github.com/rafaeldevcode' />

    <link rel="shortcut icon" href="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_favicon']) ? asset('assets/images/'.SETTINGS['site_favicon'].'') : asset('assets/images/favicon.svg') ?>" alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>">

    <meta name='author' content='Rafael Vieira | github.com/rafaeldevcode' />
    <meta name="description" content="<?php echo !is_null(SETTINGS) ? SETTINGS['site_description'] : '' ?>">

    <title>Protocolos</title>
</head>
<body>
    <main class='flex flex-nowrap justify-between w-screen'>
        <section class='w-full'>
            <section class='w-screen h-screen flex justify-center items-center' style="background: url(<?php asset($image) ?>)no-repeat; background-size: cover;">
                <div class='container text-secondary flex p-4 border rounded border-color-main m-2 custom-construction-mirror flex flex-col justify-between'>
                    <div class='text-secondary'>
                        <h2 class="text-3xl mb-2"><strong class="text-3xl">Local:</strong> <?php echo $location->name ?></h2>
                        <h2 class="text-3xl mb-2"><strong class="text-3xl">Reserva:</strong> <?php echo $reservation->name ?></h2>
                        <h2 class="text-3xl mb-2"><strong class="text-3xl">Horário:</strong> Das <?php echo $schedules[0]->hour ?> às <?php echo $schedules[$total_schedules-1]->hour ?></h2>
                        <h2 class="text-3xl mb-2"><strong class="text-3xl">Valor:</strong> R$ <?php echo number_format($total_schedules * getPrice($location->prices, $reservation->date, $reservation->day), 2, ',', ',') ?></h2>
                        <h2 class="text-3xl mb-2"><strong class="text-3xl">Status:</strong> <?php echo $reservation->status ?></h2>
                    </div>

                    <div class="p-4 rounded border bg-blue-100 text-center border-blue-600">
                        <p class="font-bold">Este protocolo também está em seu email. Um novo email será enviado toda vez que o status do seu agendamento for alterado.</p>
                    </div>
                </div>
            </section>
        </section>
    </main>
</body>
</html>
