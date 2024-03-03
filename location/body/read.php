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
            <div class='flex flex-col my-3'>
                <a href="<?php route("/location?location={$location->id}&form=1") ?>" class='btn pointer btn-color-main py-2 w-[200px] font-bold text-xl text-light' title="Reservar horários">
                    Agendar horários
                </a>
            </div>
        </div>
    </div>
</section>
