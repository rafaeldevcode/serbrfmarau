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

        <form method="POST" action="<?php route('/location/create') ?>">
            <input type="hidden" id="location_id" name="location_id" value="<?php echo $location->id ?>">
            <input type="hidden" id="type" name="type" value="<?php echo isset($client) ? $client->type : 'Normal'  ?>">
            <input type="hidden" name="create_type" value="client">
            <input type="hidden" name="email" value="<?php echo $email ?>">

            <div class='flex flex-wrap'>
                <div class='w-full md:w-6/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-person-fill',
                        'name' => 'name',
                        'label' => 'Nome',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-6/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-envelope-fill',
                        'name' => 'email',
                        'label' => 'Email',
                        'type' => 'email',
                        'value' => $email,
                        'attributes' => 'disabled'
                    ]) ?>
                </div>

                <div class='w-full md:w-6/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-telephone-fill',
                        'name' => 'phone',
                        'label' => 'Telefone',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-6/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-123',
                        'name' => 'cpf',
                        'label' => 'CPF',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-geo-alt-fill',
                        'name' => 'city',
                        'label' => 'Cidade',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-4/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-geo-alt-fill',
                        'name' => 'street',
                        'label' => 'Rua',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-2/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-geo-alt-fill',
                        'name' => 'neighborhood',
                        'label' => 'Bairro',
                        'type' => 'text',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>

                <div class='w-full md:w-2/12 px-4'>
                    <?php loadHtml(__DIR__.'/../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-123',
                        'name' => 'street_number',
                        'label' => 'Número',
                        'type' => 'number',
                        'value' => null,
                        'attributes' => 'required'
                    ]) ?>
                </div>
            </div>

            <div class='flex justify-end px-4'>
                <?php loadHtml(__DIR__.'/../../resources/partials/form/input-button', [
                    'type' => 'submit',
                    'style' => 'color-main',
                    'title' => 'Salvar cliente',
                    'value' => 'Continuar'
                ]) ?>
            </div>
        </form>
    </div>
</section>

<?php loadHtml(__DIR__.'/partials/modal-search-user', [
    'location_id' => $location->id
]) ?>
