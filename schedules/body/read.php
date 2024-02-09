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
            <?php loadHtml(__DIR__ . '/../../resources/client/partials/card-categories', [
                'categories' => $categories
            ]) ?>
        </div>
    </div>
</section>
