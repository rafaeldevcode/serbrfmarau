<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($event)): ?>
            <input type="hidden" name="id" value="<?php echo $event->id ?>">
        <?php endif ?>

        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'name',
                    'label' => 'Nome',
                    'type' => 'text',
                    'value' => isset($event) ? $event->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>
        </div>


        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'type',
                    'label' => 'Tipo',
                    'value' => isset($event) ? $event->type : null,
                    'attributes' => 'required',
                    'array' => [
                        'Normal' => 'Normal',
                        'Fixo' => 'Fixo'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'payment_type',
                    'label' => 'Tipo de pagamento',
                    'value' => isset($event) ? $event->payment_type : null,
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
                    'value' => isset($event) ? $event->amount_people : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'event',
                    'label' => 'Evento',
                    'value' => isset($event) ? $event->event : null,
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
                    'name' => 'period',
                    'label' => 'Período (Somente se for período interiro)',
                    'value' => isset($event) ? $event->period : null,
                    'attributes' => 'required',
                    'array' => [
                        '' => '----Selecione----',
                        'Manhã' => 'Manhã',
                        'Tarde' => 'Tarde',
                        'Noite' => 'Noite'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'location_id',
                    'label' => 'Local',
                    'value' => isset($event) ? $event->location_id : null,
                    'attributes' => 'required',
                    'array' => $locations
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'client_id',
                    'label' => 'Cliente',
                    'value' => isset($event) ? $event->client_id : null,
                    'attributes' => 'required',
                    'array' => $clients
                ]) ?>
            </div>
        </div>
        
        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/text-area', [
                    'icon' => 'bi bi-card-text',
                    'name' => 'observation',
                    'label' => 'Observação (Descreva aqui caso o evento for "Outros")',
                    'value' => isset($event) ? $event->observation : null
                ]) ?>
            </div>
        </div>

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Savar usuário',
                'value' => 'Salvar'
            ]) ?>
        </div>
    </form>
</section>
