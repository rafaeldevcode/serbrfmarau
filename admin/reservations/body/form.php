<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>" id="save-hours">
        <?php if(isset($reservation)): ?>
            <input type="hidden" name="id" id="reservation_id" value="<?php echo $reservation->id ?>">
        <?php endif ?>

        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'name',
                    'label' => 'Nome',
                    'type' => 'text',
                    'value' => isset($reservation) ? $reservation->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'type',
                    'label' => 'Tipo',
                    'value' => isset($reservation) ? $reservation->type : null,
                    'attributes' => 'required',
                    'array' => [
                        'Normal' => 'Normal',
                        'Fixo' => 'Fixo'
                    ]
                ]) ?>
            </div>
        </div>

        <div class='flex flex-wrap'>
            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'payment_type',
                    'label' => 'Tipo de pagamento',
                    'value' => isset($reservation) ? $reservation->payment_type : null,
                    'attributes' => 'required',
                    'array' => [
                        'Cartão de Crádito' => 'Cartão de Crádito',
                        'Cartão de débito' => 'Cartão de débito',
                        'Pix' => 'Pix',
                        'Dinheiro' => 'Dinheiro'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-people-fill',
                    'name' => 'amount_people',
                    'label' => 'Quantidade de Pessoas',
                    'type' => 'number',
                    'value' => isset($reservation) ? $reservation->amount_people : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'event',
                    'label' => 'Evento',
                    'value' => isset($reservation) ? $reservation->event : null,
                    'attributes' => 'required',
                    'array' => [
                        'Aniverssário' => 'Aniverssário',
                        'Casamento' => 'Casamento',
                        'Formatura' => 'Formatura',
                        'Outros' => 'Outros'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'location_id',
                    'label' => 'Local',
                    'value' => isset($reservation) ? $reservation->location_id : null,
                    'attributes' => 'required',
                    'array' => $locations,
                    'attributes' => [
                        'data-change' => 'locations'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'status',
                    'label' => 'Status',
                    'value' => isset($reservation) ? $reservation->status : null,
                    'attributes' => 'required',
                    'array' => [
                        'Pendente' => 'Pendente',
                        'Aprovado' => 'Aprovado',
                        'Reprovado' => 'Reprovado'
                    ]
                ]) ?>
            </div>
        </div>
        
        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/text-area', [
                    'icon' => 'bi bi-card-text',
                    'name' => 'observation',
                    'label' => 'Observação (Descreva aqui caso o evento for "Outros")',
                    'value' => isset($reservation) ? $reservation->observation : null
                ]) ?>
            </div>
        </div>

        <div class="px-4">
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
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
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Salvar reserva',
                'value' => 'Salvar'
            ]) ?>
        </div>

        <?php loadHtml(__DIR__.'/../../../resources/partials/modal-hours', ['reservation' => isset($reservation) ? $reservation : null]) ?>
    </form>
</section>
