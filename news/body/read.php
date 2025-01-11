<?php loadHtml(__DIR__ . '/../../resources/client/partials/block-one', [
    'image' => !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? SETTINGS['site_bg_login'] : 'login_bg.jpg',
    'title' => !is_null(SETTINGS) && !empty(SETTINGS['site_description']) ? SETTINGS['site_description'] : '',
    'show_search' => true,
]) ?>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../../resources/client/partials/title', [
            'title' => isset(requests()->search) ? 'Resultados para "'.requests()->search.'"' : 'Notícias'
        ]) ?>

        <div class="flex flex-wrap justify-start items-center mt-12">
            <?php if(empty($posts->data)): ?>
                <div class="border border-color-main rounded p-4 shadow-lg w-full">
                    <p class="text-center font-semibold text-secondary">Nenhuma notícia cadastrada para essa categoria!</p>
                </div>
            <?php else: ?>
                <?php foreach($posts->data as $post): 
                    loadHtml(__DIR__.'/../../resources/client/partials/article-card', [
                        'thumbnail' => $post->thumbnail,
                        'title' => $post->title,
                        'excerpt' => $post->excerpt,
                        'slug' => $post->slug
                    ]);
                endforeach ?>
            <?php endif ?>
        </div>

        <?php if(count($posts->data) == 0): ?>
            <div class="p-2 empty-collections flex justify-center items-center">
                <img class="h-full" src="<?php asset('assets/images/empty.svg') ?>" alt="Nenhum dado encontrado">
            </div>
        <?php endif; ?>

        <div class="p-4">
            <?php if(isset($posts->page)):
                loadHtml(__DIR__.'/../../resources/admin/partials/pagination', [
                    'page'   => $posts->page,
                    'count'  => $posts->count,
                    'next'   => $posts->next,
                    'prev'   => $posts->prev,
                    'search' => $posts->search
                ]);
            endif; ?>
        </div>
    </div>
</section>


