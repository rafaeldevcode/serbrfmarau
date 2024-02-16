<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route($action) ?>">
        <?php if(isset($user)): ?>
            <input type="hidden" name="id" value="<?php echo $user->id ?>">
        <?php endif ?>

        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-person-fill',
                    'name' => 'name',
                    'label' => 'Nome do usuário',
                    'type' => 'text',
                    'value' => isset($user) ? $user->name : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-envelope-fill',
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => isset($user) ? $user->email : null,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-key-fill',
                    'name' => 'password',
                    'type' => 'password',
                    'label' => 'Digite a nova senha (Deixa em branco caso não queira alterar)'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-key-fill',
                    'name' => 'repeat_password',
                    'type' => 'password',
                    'label' => 'Repita a nova senha'
                ]) ?>
            </div>
        </div>

        <div class='w-full md:w-6/12 px-4'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                'name' => 'status',
                'label' => 'Status do usuário (Inativo | Ativo)',
                'value' => isset($user) ? $user->status : null
            ]) ?>
        </div>

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Salvar usuário',
                'value' => 'Salvar'
            ]) ?>
        </div>
    </form>
</section>
