<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($category)): ?>
            <input type="hidden" name="id" value="<?php echo $category->id ?>">
        <?php endif ?>

        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'name',
                    'label' => 'Nome',
                    'type' => 'text',
                    'value' => isset($category) ? $category->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-alphabet-uppercase',
                    'name' => 'description',
                    'label' => 'Descrição',
                    'type' => 'text',
                    'value' => isset($category) ? $category->description : null
                ]) ?>
            </div>
        </div>

        <div class='w-full flex flex-wrap px-3'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                'name' => 'thumbnail',
                'label' => 'Imagem de destaque',
                'value' => isset($category) ? $category->thumbnail : null,
                'type' => 'radio',
                'attributes' => 'required'
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
