<div class="w-full lg:w-4/12 md:w-6/12 p-6">
    <div class="border border-gray-300 rounded-md shadow-md">
        <div class="w-full h-[300px]">
            <?php loadHtml(__DIR__.'/thumbnail', [
                'id' => $thumbnail, 
                'alt' => $title,
                'class' => 'w-full h-[300px] object-cover object-center rounded-t-md'
            ])?>
        </div>

        <div class="p-6 space-y-4">
            <h2 class="font-semibold text-lg max-lenght max-lenght-2 font-main"><?php echo $title ?></h2>

            <p class="max-lenght max-lenght-4"><?php echo $excerpt ?></p>
        
            <a class="block w-8/12 mx-auto py-2 px-4 text-lg btn-color-main text-center rounded-md" href="<?php route("/news/{$slug}") ?>" title="Ler mais">
                CONTINUE LENDO
            </a>
        </div>
    </div>
</div>
