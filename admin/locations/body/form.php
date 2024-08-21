<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>" id="save-location">
        <?php if(isset($location)): ?>
            <input type="hidden" name="id" value="<?php echo $location->id ?>">
        <?php endif ?>

        <div class='flex flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'name',
                    'label' => 'Nome',
                    'type' => 'text',
                    'value' => isset($location) ? $location->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-envelope-fill',
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => isset($location) ? $location->email : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-3/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-clock-fill',
                    'name' => 'start_hour',
                    'label' => 'Hora Inicial',
                    'type' => 'time',
                    'value' => isset($location) ? $location->start_hour : null,
                    'attributes' => [
                        'required' => true,
                        'data-input' => 'hour'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-3/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-clock-fill',
                    'name' => 'end_hour',
                    'label' => 'Hora Final',
                    'type' => 'time',
                    'value' => isset($location) ? $location->end_hour : null,
                    'attributes' => [
                        'required' => true,
                        'data-input' => 'hour'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'category_id',
                    'label' => 'Categoria',
                    'value' => isset($location) ? $location->category_id : null,
                    'array' => $categories,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'opening',
                    'label' => 'Período de abertura',
                    'value' => isset($location) ? $location->opening : null,
                    'attributes' => 'required',
                    'array' => [
                        'P1D' => '1 Dia',
                        'P1W' => '1 Semana',
                        'P1M' => '1 Mês',
                        'P1Y' => '1 Ano'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'type',
                    'label' => 'Tipo de locação',
                    'value' => isset($location) ? $location->type : null,
                    'attributes' => 'required',
                    'array' => [
                        '' => '----Selecione----',
                        'period' => 'Por período',
                        'hour' => 'Por hora'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'opening_days[]',
                    'label' => 'Dias de abertura',
                    'value' => isset($location) ? json_decode($location->opening_days, true) : null,
                    'attributes' => [
                        'required' => 'required',
                        'multiple' => 'multiple',
                    ],
                    'array' => [
                        '' => '----Selecione----',
                        'Sunday' => 'Domingo',
                        'Monday' => 'Segunda',
                        'Tuesday' => 'Terça',
                        'Wednesday' => 'Quarta',
                        'Thursday' => 'Quinta',
                        'Friday' => 'Sexta',
                        'Saturday' => 'Sábado'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/text-area', [
                    'icon' => 'bi bi-card-text',
                    'name' => 'description',
                    'label' => 'Descrição',
                    'value' => isset($location) ? $location->description : null
                ]) ?>
            </div>
        </div>

        <div class='w-full flex flex-wrap px-3'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                'name' => 'images',
                'label' => 'Galeria de imagens',
                'images' => isset($location) ? $images : null,
                'type' => 'checkbox',
            ]) ?>
        </div>

        <div class='w-full md:w-6/12 px-4'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                'name' => 'status',
                'label' => 'Status do local (Inativo | Ativo)',
                'value' => isset($location) ? $location->status : null
            ]) ?>
        </div>

        <div class="px-4">
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'button',
                'style' => 'color-main',
                'title' => 'Definir preço',
                'value' => 'Definir preço',
                'attributes' => [
                    'data-toggle' => 'prices'
                ]
            ]) ?>
        </div>

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Salvar local',
                'value' => 'Salvar'
            ]) ?>
        </div>

        <?php loadHtml(__DIR__.'/partials/modal-prices', ['days' => isset($location) ? json_decode($location->prices, true) : null]) ?>
        <?php loadHtml(__DIR__.'/partials/modal-prices-day', ['days' => isset($location) ? json_decode($location->prices, true) : null]) ?>
    </form>
</section>
