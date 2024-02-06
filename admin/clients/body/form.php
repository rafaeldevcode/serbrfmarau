<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($client)): ?>
            <input type="hidden" name="id" value="<?php echo $client->id ?>">
        <?php endif ?>

        <div class='flex flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-person-fill',
                    'name' => 'name',
                    'label' => 'Nome',
                    'type' => 'text',
                    'value' => isset($client) ? $client->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-envelope-fill',
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => isset($client) ? $client->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-telephone-fill',
                    'name' => 'phone',
                    'label' => 'Telefone',
                    'type' => 'text',
                    'value' => isset($client) ? $client->phone : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-123',
                    'name' => 'cpf',
                    'label' => 'CPF',
                    'type' => 'text',
                    'value' => isset($client) ? $client->cpf : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'city',
                    'label' => 'Cidade',
                    'type' => 'text',
                    'value' => isset($client) ? $client->city : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'street',
                    'label' => 'Rua',
                    'type' => 'text',
                    'value' => isset($client) ? $client->street : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-2/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'neighborhood',
                    'label' => 'Bairro',
                    'type' => 'text',
                    'value' => isset($client) ? $client->neighborhood : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-2/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-123',
                    'name' => 'street_number',
                    'label' => 'Número',
                    'type' => 'number',
                    'value' => isset($client) ? $client->street_number : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-2/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'type',
                    'label' => 'Tipo de cliente',
                    'value' => isset($client) ? $client->type : null,
                    'array' => [
                        'Normal' => 'Normal',
                        'Sócio' => 'Sócio'
                    ]
                ]) ?>
            </div>
        </div>

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Savar cliente',
                'value' => 'Salvar'
            ]) ?>
        </div>
    </form>
</section>
