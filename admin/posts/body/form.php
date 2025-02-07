<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($post)): ?>
            <input type="hidden" name="id" value="<?php echo $post->id ?>">
        <?php endif ?>
        
        <div class='flex justify-between flex-col-reverse lg:flex-row'>
            <div class="w-full lg:w-9/12 mt-4">
                <textarea id="tinymce" name="content"><?php echo isset($post) ? $post->content : null ?></textarea>
            </div>

            <div class="w-full lg:w-3/12 px-4">
                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-hash',
                        'name' => 'title',
                        'label' => 'Título',
                        'type' => 'text',
                        'attributes' => 'required',
                        'value' => isset($post) ? $post->title : null
                    ]) ?>
                </div>

                <div class='w-full pt-1'>
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                        'icon' => 'bi bi-link',
                        'name' => 'slug',
                        'label' => 'Slug (Sem espaços e aacentos)',
                        'type' => 'text',
                        'value' => isset($post) ? $post->slug : null
                    ]) ?>
                </div>

                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-select', [
                        'icon' => 'bi bi-hash',
                        'name' => 'status',
                        'label' => 'Status',
                        'value' => isset($post) ? $post->status : null,
                        'array' => [
                            'published' => 'Publicado',
                            'draft' => 'Rascunho'
                        ]
                    ]) ?>
                </div>

                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                        'name' => 'show_home',
                        'label' => 'Exibir na página inicial (Não | Sim)',
                        'value' => isset($post) ? $post->show_home : null
                    ]) ?>
                </div>

                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                        'name' => 'thumbnail',
                        'label' => 'Imagen de destaque',
                        'value' => isset($post) ? $post->thumbnail : null,
                        'type' => 'radio',
                    ]) ?>
                </div>
            </div>
        </div>

        <div class='w-full flex flex-wrap my-4'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                'name' => 'collection',
                'label' => 'Galeria de imagens',
                'images' => isset($post) ? $images : null,
                'type' => 'checkbox',
            ]) ?>
        </div>

        <div class='flex justify-end mt-4'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type'  => 'submit',
                'style' => 'color-main',
                'title' => 'Savar banner',
                'value' => 'Salvar post'
            ]) ?>
        </div>
    </form>
</section>
