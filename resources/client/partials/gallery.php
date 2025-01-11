<section class="my-6">
    <h3 class="font-main font-bold text-2xl mb-6 relative after:content-[''] after:absolute after:bottom-[-5px] after:left-0 after:w-full after:h-[3px] after:bg-color-main text-secondary">Galeria</h3>

    <div class="flex flex-wrap" id="gallery">
        <?php foreach($images as $image): ?>
            <div class="w-full sm:w-[190px] h-[190px] rounded border border-color-main pointer shadow-lg m-2">
                <img 
                    class="rounded w-full h-[190px] object-cover" src="<?php asset("assets/images/{$image->file}") ?>" 
                    alt="<?php $image->name ?>"
                    data-gallery="preview"
                >
            </div>
        <?php endforeach ?>

        <?php if(empty($images)): ?>
            <div class="text-center w-full p-4 rounded border border-color-main text-secondary shadow-lg">
                Nenhuma imagem disponível!
            </div>
        <?php endif ?>
    </div>
</section>

<!-- Modal Gallery Preview -->
<?php loadHtml(__DIR__.'/../../admin/partials/gallery-preview') ?>
