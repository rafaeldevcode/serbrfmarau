<?php loadHtml(__DIR__ . '/../../resources/client/partials/block-one', [
    'image' => !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? SETTINGS['site_bg_login'] : 'login_bg.jpg',
    'title' => !is_null(SETTINGS) && !empty(SETTINGS['site_description']) ? SETTINGS['site_description'] : ''
]) ?>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../../resources/client/partials/title', [
            'title' => 'Nossos Locais',
            'subtitle' => 'Conheça a Nossa História: Paixão, Compromisso e Excelência'
        ]) ?>

        <div class="flex flex-wrap items-center justify-center mt-12">
            <?php foreach($categories as $category): ?>
                <div class="p-2">
                    <a href="<?php route("/category/{$category->id}") ?>" class="block rounded w-[200px] h-[200px] relative hover:scale-105 transition duration-150 ease-in-out">
                        <?php loadHtml(__DIR__ . '/../../resources/client/partials/thumbnail', [
                            'class' => 'w-[200px] h-[200px] rounded object-cover absolute top-0 left-0 z-[1]',
                            'id' => $category->thumbnail
                        ]) ?>

                        <p class="bg-[#00000085] flex items-end z-[2] w-full h-full rounded relative text-white text-2xl font-bold p-2"><?php echo $category->name ?></p>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
