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

    <title>Protocolos</title>
</head>
<body>
    <main class='flex flex-nowrap justify-between w-screen'>
        <section class='w-full'>
            <section class='w-screen h-screen flex justify-center items-center' style="background: url(<?php asset($image) ?>)no-repeat; background-size: cover;">
                <div class='container text-secondary flex p-4 border rounded border-color-main m-2 custom-construction-mirror'>
                    <?php if(is_null($protocol)): ?>
                        <div class='flex justify-center w-full'>
                            <p class='text-3xl'>Ops, protocolo não encontrado!</p>
                        </div>
                    <?php else: ?>
                        <div class='text-secondary'>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Cliente:</strong> <?php echo $client->name ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Local:</strong> <?php echo $location->name ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Evento:</strong> <?php echo $event->name ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Horário:</strong> Das <?php echo $schedules[0]->hour ?> às <?php echo $schedules[$total_schedules-1]->hour ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Valor:</strong> R$ <?php echo $total_schedules * $location->price ?></h2>
                        </div>
                    <?php endif ?>
                </div>
            </section>
        </section>
    </main>
</body>
</html>
