<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($location)): ?>
            <input type="hidden" name="id" value="<?php echo $location->id ?>">
        <?php endif ?>

        <div class='flex justify-between flex-wrap'>
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
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'city',
                    'label' => 'Cidade',
                    'type' => 'text',
                    'value' => isset($location) ? $location->city : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-5/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'street',
                    'label' => 'Rua',
                    'type' => 'text',
                    'value' => isset($location) ? $location->street : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-5/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'neighborhood',
                    'label' => 'Bairro',
                    'type' => 'text',
                    'value' => isset($location) ? $location->neighborhood : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-2/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-123',
                    'name' => 'street_number',
                    'label' => 'Númreo',
                    'type' => 'number',
                    'value' => isset($location) ? $location->street_number : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-clock-fill',
                    'name' => 'start_hour',
                    'label' => 'Númreo',
                    'type' => 'time',
                    'value' => isset($location) ? $location->start_hour : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-clock-fill',
                    'name' => 'end_hour',
                    'label' => 'Número',
                    'type' => 'time',
                    'value' => isset($location) ? $location->end_hour : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'category_id',
                    'label' => 'Categoria',
                    'value' => isset($location) ? $location->category_id : null,
                    'array' => $categories
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'opening',
                    'label' => 'Período de abertura',
                    'value' => isset($location) ? $location->opening : null,
                    'array' => [
                        '1 Dia' => '1 Dia',
                        '1 Semana' => '1 Semana',
                        '1 Mês' => '1 Mês',
                        '1 Ano' => '1 Ano'
                    ]
                ]) ?>
            </div>
        </div>

        <div class='w-full flex flex-wrap my-4'>
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

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Savar local',
                'value' => 'Salvar'
            ]) ?>
        </div>
    </form>
</section>
