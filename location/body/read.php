<section id="carousel">
    <?php foreach($images as $image): 
        loadHtml(__DIR__ . '/../../resources/client/partials/block-one', [
            'image' => $image->file
        ]);
    endforeach?>
</section>

<section class="py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../../resources/client/partials/title', [
            'title' => $location->name,
            'subtitle' => $location->description
        ]) ?>

        <?php loadHtml(__DIR__.'/../../resources/partials/hours-available', [
            'location_id' => $location->id,
            'is_admin' => false,
            'route' => '/location/create'
        ]) ?>
    </div>
</section>
