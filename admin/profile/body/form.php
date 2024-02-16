<section class='p-3 bg-white m-0 sm:m-3 rounded shadow-lg'>
    <div class='relative'>
        <div class='relative profile-bg' style="background-image: url(<?php !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? asset('assets/images/'.SETTINGS['site_bg_login'].'') : asset('assets/images/login_bg.jpg') ?>)"></div>

        <div class='mx-auto relative profile-user'>
            <img class='border border-color-main w-full absolute bottom-0 left-0' src='<?php asset('/assets/images/users/'.$user->avatar) ?>' alt='<?php echo $user->name ?>'/>

            <button
                class='absolute bottom-0 left-0 w-full h-full bg-white profile-user-btn font-bold text-color-main'
                data-toggle="avatar"
                title="Abrir modal com imagens de perfil"
            >
                Alterar
            </button>
        </div>

        <div class='absolute top-0 left-0 m-3 text-color-main'>
            <p class='p-0 m-0 text-3xl font-bold'><?php echo $user->name ?></p>
        </div>

        <div class='absolute top-0 right-0 m-3'>
            <span class='text-light bg-<?php echo (is_null($user->status) || $user->status == 'off') ? 'danger' : 'primary' ?> rounded px-2 py-1 font-bold'>
                <i class='bi bi-circle-fill'></i>
                <?php echo (is_null($user->status) || $user->status == 'off') ? 'Inativo' : 'Ativo' ?>
            </span>
        </div>
    </div>

    <form method="POST" action="<?php route('/admin/profile/update') ?>">
        <input type="hidden" name="id" value="<?php echo $user->id ?>">

        <div class='flex justify-between flex-wrap'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-person-fill',
                    'name' => 'name',
                    'label' => 'Nome do usuário',
                    'type' => 'bi bi-person-fill',
                    'value' => $user->name,
                    'attributes' => 'required'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-envelope-fill',
                    'name' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'value' => $user->email,
                    'attributes' => [
                        'required' => 'required',
                        'disabled' => 'disabled'
                    ]
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-key-fill',
                    'name' => 'current_password',
                    'type' => 'password',
                    'label' => 'Senha atual (Deixe em branco caso não queira altera-la)'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-key-fill',
                    'name' => 'password',
                    'type' => 'password',
                    'label' => 'Nova senha'
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-key-fill',
                    'name' => 'repeat_password',
                    'type' => 'password',
                    'label' => 'Repita sua nova senha'
                ]) ?>
            </div>
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

<?php loadHtml(__DIR__.'/../../../resources/admin/partials/modal-avatars', ['user_id' => $user->id, 'avatar' => $user->avatar]) ?>
