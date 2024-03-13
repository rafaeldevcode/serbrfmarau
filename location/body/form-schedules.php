<section id="carousel">
    <?php foreach($images as $image): 
        loadHtml(__DIR__ . '/../../resources/client/partials/block-one', [
            'image' => $image->file
        ]);
    endforeach?>
</section>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../../resources/client/partials/title', [
            'title' => $location->name
        ]) ?>

        <div class="text-center py-6">
            <h2 class="text-secondary text-xl font-bold">Para proseguir preencha seus dados pessoais e clique em continuar</h2>
        </div>

        <form method="POST" action="<?php route('/location/create') ?>" id="save-hours">
            <input type="hidden" id="location_id" name="location_id" value="<?php echo $location->id ?>">
            <input type="hidden" name="create_type" value="schedule">

            <div class='flex justify-between flex-wrap'>
                <div class='w-full md:w-6/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-alphabet-uppercase',
                        'name' => 'name',
                        'label' => 'Nome da reserva',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>
            </div>

            <div class='flex flex-wrap'>
                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-envelope-fill',
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-telephone-fill',
                        'name' => 'phone',
                        'label' => 'Telefone',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-123',
                        'name' => 'identifier',
                        'label' => 'CPF',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'payment_type',
                        'label' => 'Tipo de pagamento',
                        'value' => null,
                        'attributes' => 'required',
                        'array' => [
                            'Cartão de Crédito' => 'Cartão de Crédito',
                            'Cartão de Débito' => 'Cartão de Débito',
                            'Pix' => 'Pix',
                            'Dinheiro' => 'Dinheiro'
                        ]
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-people-fill',
                        'name' => 'amount_people',
                        'label' => 'Quantidade de Pessoas',
                        'type' => 'number',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'event',
                        'label' => 'Evento',
                        'value' => null,
                        'attributes' => 'required',
                        'array' => [
                            'Aniversário' => 'Aniversário',
                            'Casamento' => 'Casamento',
                            'Formatura' => 'Formatura',
                            'Outros' => 'Outros'
                        ]
                    ]) ?>
                </div>
            </div>
            
            <div class='flex justify-between flex-wrap'>
                <div class='w-full px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/text-area', [
                        'icon' => 'bi bi-card-text',
                        'name' => 'observation',
                        'label' => 'Observação (Descreva aqui caso o evento for "Outros")',
                        'value' => isset($reservation) ? $reservation->observation : null
                    ]) ?>
                </div>
            </div>

            <div class="px-4">
                <?php loadHtml(__DIR__.'/../../resources/partials/form/input-button', [
                    'type' => 'button',
                    'style' => 'color-main',
                    'title' => 'Escolher horários',
                    'value' => 'Escolher horários',
                    'attributes' => [
                        'id' => 'get-hours'
                    ]
                ]) ?>
            </div>

            <div class='flex justify-end px-4'>
                <?php loadHtml(__DIR__.'/../../resources/partials/form/input-button', [
                    'type' => 'submit',
                    'style' => 'color-main',
                    'title' => 'Agendar horários',
                    'value' => 'Agendar'
                ]) ?>
            </div>

            <?php loadHtml(__DIR__.'/../../resources/partials/modal-hours', ['reservation' => null]) ?>
        </form>
    </div>
</section>
