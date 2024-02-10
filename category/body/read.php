<?php loadHtml(__DIR__ . '/../../resources/client/partials/block-one', [
    'image' => getImagePath($category->thumbnail),
    'title' => !is_null(SETTINGS) && !empty(SETTINGS['site_description']) ? SETTINGS['site_description'] : ''
]) ?>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../../resources/client/partials/title', [
            'title' => $category->name,
            'subtitle' => $category->description
        ]) ?>

        <div class="flex flex-wrap justify-center items-center mt-12">
            <?php if(empty($locations->data)): ?>
                <div class="border border-color-main rounded p-4 shadow-lg w-full">
                    <p class="text-center font-semibold text-secondary">Nenhum local cadastrado para essa categoria!</p>
                </div>
            <?php else: ?>
                <?php foreach($locations->data as $location): ?>
                    <div class="p-2">
                        <a href="<?php route("/location/{$location->id}") ?>" class="block rounded w-[400px] h-[400px] relative hover:scale-105 transition duration-150 ease-in-out">
                            <img class="'w-[400px] h-[400px] rounded object-cover absolute top-0 left-0 z-[1]'" 
                                src="<?php asset("assets/images/".getImagesLocation($location->id)[0]?->file) ?>" 
                                alt="<?php echo $location->name ?>"
                            >

                            <p class="bg-[#00000085] flex items-end z-[2] w-full h-full rounded relative text-white text-2xl font-bold p-2"><?php echo $location->name ?></p>
                        </a>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>
