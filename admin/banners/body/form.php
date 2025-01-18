<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($banner)): ?>
            <input type="hidden" name="id" value="<?php echo $banner->id ?>">
        <?php endif ?>

        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'title',
                    'label' => 'Título',
                    'type' => 'text',
                    'value' => isset($banner) ? $banner->title : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'subtitle',
                    'label' => 'Subtítulo',
                    'type' => 'text',
                    'value' => isset($banner) ? $banner->subtitle : null
                ]) ?>
            </div>

            <div class='w-full md:w-4/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-link',
                    'name' => 'link',
                    'label' => 'Link',
                    'type' => 'text',
                    'value' => isset($banner) ? $banner->link : null
                ]) ?>
            </div>
        </div>

        <div class='w-full flex flex-wrap px-3'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                'name' => 'desktop',
                'label' => 'Banner Desktop',
                'value' => isset($banner) ? $banner->desktop : null,
                'type' => 'radio',
                'attributes' => 'required'
            ]) ?>

            <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                'name' => 'mobile',
                'label' => 'Banner Mobile',
                'value' => isset($banner) ? $banner->mobile : null,
                'type' => 'radio',
                'attributes' => 'required'
            ]) ?>
        </div>

        <div class='w-full md:w-6/12 px-4 mt-4'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                'name' => 'status',
                'label' => 'Status do banner (Inativo | Ativo)',
                'value' => isset($banner) ? $banner->status : null
            ]) ?>
        </div>

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Salvar categoria',
                'value' => 'Salvar'
            ]) ?>
        </div>
    </form>
</section>
