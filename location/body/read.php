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

        <div class="flex flex-wrap justify-center items-center mt-12">
            <?php loadHtml(__DIR__.'/../../resources/partials/form/input-button', [
                'type' => 'button',
                'style' => 'color-main',
                'title' => 'Agendar horário',
                'value' => 'Agendar horário',
                'attributes' => [
                    'data-toggle' => 'search-user'
                ]
            ]) ?>
        </div>
    </div>
</section>

<?php loadHtml(__DIR__.'/partials/modal-search-user', [
    'location_id' => $location->id
]) ?>
