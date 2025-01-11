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
            'title' => $post->title,
        ]) ?>

        <article class="mt-6 article">
            <?php echo $post->content ?>
        </article>

        <?php loadHtml(__DIR__.'/../../resources/client/partials/author-card', [
            'id' => $post->user_id,
            'created' => $post->created_at,
            'excerpt' => $post->excerpt
        ]); ?>

        <!-- Include gallery -->
        <?php loadHtml(__DIR__.'/../../resources/client/partials/gallery', ['images' => $images]) ?>
    </div>
</section>
