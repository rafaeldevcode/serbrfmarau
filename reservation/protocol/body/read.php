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
                    <?php if(isset($reservation)): ?>
                        <div class='text-secondary'>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Local:</strong> <?php echo $location->name ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Reserva:</strong> <?php echo $reservation->name ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Horário:</strong> Das <?php echo getBtweenHours($reservation->id) ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Valor:</strong> R$ <?php echo number_format($total_schedules * getPrice($location->prices, $reservation->date, $reservation->day, $reservation->is_partner), 2, ',', ',') ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Status:</strong> <?php echo $reservation->status ?></h2>
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Protocolo:</strong> <?php echo $protocol->token ?></h2>
                        </div>

                        <div class="flex justify-center">
                            <a href="<?php echo route('/') ?>" title="Página inicial" class='text-center mt-4 btn btn-color-main text-light'>Página inicial</a>
                        </div>

                        <div class="p-4 rounded border bg-blue-100 text-center border-blue-600">
                            <?php if($reservation->payment_type === 'Pix' && !is_null(SETTINGS) && !empty(SETTINGS['pix_key'])): ?>
                                <p class="font-bold">Seu pagamento pode ser feito através do pix <span class="text-color-main"><?php echo SETTINGS['pix_key'] ?>.</span></p>
                            <?php elseif(!is_null(SETTINGS) && !empty(SETTINGS['pix_key'])): ?>   
                                <p class="font-bold">Seu método de pagamento é <span class="text-color-main"><?php echo $reservation->payment_type ?></span>, mas se desejar pode efetuar o pagamento via pix: <span class="text-color-main"><?php echo SETTINGS['pix_key'] ?>.</p>
                            <?php endif ?>

                            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['whatsapp'])): ?>
                                <p class="font-bold">Envie comprovante para <span class="text-color-main"><?php echo SETTINGS['whatsapp'] ?></span> juntamente com seu protocolo <span class="text-color-main"><?php echo $protocol->token ?></span>.</p>
                            <?php endif ?>

                            <p class="font-bold">Este protocolo também está em seu email. Um novo email será enviado toda vez que o status do seu agendamento for alterado.</p>
                        </div>
                    <?php else: ?>
                        <form action="?" class="flex flex-col justify-center items-center">
                            <h2 class="text-3xl mb-2"><strong class="text-3xl">Procure aqui uma reserva usando o protocolo</strong></h2>

                            <div class="w-full md:w-6/12">
                                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                                    'icon' => 'bi bi-123',
                                    'name' => 'protocol',
                                    'label' => 'Protocolo',
                                    'type' => 'text',
                                    'value' => null,
                                    'attributes' => 'required'
                                ]) ?>
                            </div>

                            <div>
                                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                                    'type' => 'submit',
                                    'style' => 'color-main',
                                    'title' => 'Buscar',
                                    'value' => 'Buscar'
                                ]) ?>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </section>
        </section>
    </main>

    <!-- Include flash message -->
    <?php loadHtml(__DIR__.'/../../../resources/partials/message') ?>

    <script type="text/javascript" src="<?php asset('libs/jquery/jquery.js?ver='.APP_VERSION)?>"></script>
    <script type="text/javascript" src="<?php asset('assets/scripts/main.js?ver='.APP_VERSION) ?>"></script>
    
    <script type="text/javascript" src="<?php asset('assets/scripts/class/Message.js?ver='.APP_VERSION) ?>"></script>
    <script type="text/javascript">
        Message.hide('[data-message]');

        $('form').on('submit', (event) => {
            event.preventDefault();
            const protocol = $('#protocol').val();

            window.location = route(`/reservation/protocol/${protocol}`);
        });
    </script>
</body>
</html>
