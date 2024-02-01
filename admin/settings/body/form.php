<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <form method="POST" action="<?php route('/admin/settings/update') ?>" enctype="multipart/form-data">
        <div class='flex flex-wrap justify-between'>
            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-link',
                    'name' => 'site_name',
                    'label' => 'Nome do site',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->site_name : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-card-text',
                    'name' => 'site_description',
                    'label' => 'Descrição do site',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->site_description : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-geo-alt-fill',
                    'name' => 'andress',
                    'label' => 'Endereço da empresa',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->andress : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-telephone-fill',
                    'name' => 'phone',
                    'label' => 'Telefone da empresa (adicionar DDD)',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->phone : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-envelope-fill',
                    'name' => 'email',
                    'label' => 'Email da empresa',
                    'type' => 'email',
                    'value' => isset($settings) ? $settings->email : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-linkedin',
                    'name' => 'profile_linkedin',
                    'label' => 'linkedin da empresa',
                    'type' => 'url',
                    'value' => isset($settings) ? $settings->profile_linkedin : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-facebook',
                    'name' => 'profile_facebook',
                    'label' => 'Facebook da empresa',
                    'type' => 'url',
                    'value' => isset($settings) ? $settings->profile_facebook : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-instagram',
                    'name' => 'profile_instagram',
                    'label' => 'Instagram da empresa',
                    'type' => 'url',
                    'value' => isset($settings) ? $settings->profile_instagram : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-twitter',
                    'name' => 'profile_twitter',
                    'label' => 'Twitter da empresa',
                    'type' => 'url',
                    'value' => isset($settings) ? $settings->profile_twitter : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-whatsapp',
                    'name' => 'whatsapp',
                    'label' => 'Whatsapp da empresa (adicionar DDD)',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->whatsapp : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-chat-quote-fill',
                    'name' => 'whatsapp_message',
                    'label' => 'Menssagem padrão para o whatsapp',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->whatsapp_message : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-telegram',
                    'name' => 'telegram',
                    'label' => 'Telegram da empresa (Usar o nome de usuário)',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->telegram : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-chat-quote-fill',
                    'name' => 'telegram_message',
                    'label' => 'Menssagem padrão para o telegram',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->telegram_message : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-c-circle-fill',
                    'name' => 'copyright',
                    'label' => 'Copyright no rodapé do site',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->copyright : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-facebook',
                    'name' => 'facebook_pixel',
                    'label' => 'Pixel do facebook',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->facebook_pixel : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-tiktok',
                    'name' => 'tiktok_pixel',
                    'label' => 'Pixel do tiktok',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->tiktok_pixel : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-google',
                    'name' => 'google_analytics_pixel',
                    'label' => 'Pixel do google analytics',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->google_analytics_pixel : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-google',
                    'name' => 'googleads_pixel',
                    'label' => 'Pixel do google ads',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->googleads_pixel : ''
                ]) ?>
            </div>

            <div class='w-full md:w-6/12 px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                    'icon' => 'bi bi-google',
                    'name' => 'tagmanager_pixel',
                    'label' => 'Pixel do google tagmanager',
                    'type' => 'text',
                    'value' => isset($settings) ? $settings->tagmanager_pixel : ''
                ]) ?>
            </div>

            <div class='w-full px-4'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                    'name' => 'cookies',
                    'label' => 'Ativar aviso de cookies (Inativo | Ativo)',
                    'value' => isset($settings) ? $settings->cookies : 'off'
                ]) ?>
            </div>

            <div class="w-full px-4">
                <div class='w-full'>
                    <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-checkbox-switch', [
                        'name' => 'preloader',
                        'label' => 'Ativar preloader (Inativo | Ativo)',
                        'value' => isset($settings) ? $settings->preloader : 'off',
                        'attributes' => 'onclick="Preloader.habilit(event);"'
                    ]) ?>

                    <p class="text-secondary">Preloader é uma animação que é executada até que a página esteja carregada e pronta para ser exibida.</p>
                </div>

                <div id="box-preloader" class="border border-color-main rounded" style="display: <?php echo !isset($settings) || $settings->preloader == 'off' ? 'none' : 'flex' ?>;">
                    <div class="p-2">
                        <p class="text-secondary">Escolha uma imagem de animação</p>
                    </div>

                    <div class="flex flex-wrap justify-center">
                        <?php foreach (getPreloaders() as $indice => $image): ?>
                            <div class='m-2'>
                                <input data-checked="add-style" hidden type='radio' name='preloader_image' id='<?php echo $indice ?>' value='<?php echo $image['src'] ?>' <?php echo isset($settings) && $image['src'] == $settings->preloader_image ? 'checked' : '' ?>>
                                <label for='<?php echo $indice ?>' class='block rounded label-image-profile border border-secondary'>
                                    <img class="w-full rounded" src="<?php asset("/assets/images/preloaders/{$image['src']}") ?>" alt="<?php echo $image['alt'] ?>">
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class='w-full flex flex-wrap mt-6 px-3'>
                <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                    'name' => 'site_logo_main',
                    'label' => 'Logo principal (Cor principal)',
                    'value' => (isset($settings) && !empty($settings->site_logo_main)) ? $settings->site_logo_main : null,
                    'type' => 'radio',
                ]) ?>

                <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                    'name' => 'site_logo_secondary',
                    'label' => 'Logo segundário (Na cor branca)',
                    'value' => (isset($settings) && !empty($settings->site_logo_secondary)) ? $settings->site_logo_secondary : null,
                    'type' => 'radio',
                ]) ?>

                <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                    'name' => 'site_favicon',
                    'label' => 'Favicon do site',
                    'value' => (isset($settings) && !empty($settings->site_favicon)) ? $settings->site_favicon : null,
                    'type' => 'radio',
                ]) ?>

                <?php loadHtml(__DIR__.'/../../../resources/partials/form/button-upload', [
                    'name' => 'site_bg_login',
                    'label' => 'Fundo da tela de login',
                    'value' => (isset($settings) && !empty($settings->site_bg_login)) ? $settings->site_bg_login : null,
                    'type' => 'radio',
                ]) ?>
            </div>
        </div>

        <div class='flex justify-end'>
            <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-button', [
                'type' => 'submit',
                'style' => 'color-main',
                'title' => 'Savar configurações',
                'value' => 'Salvar'
            ]) ?>
        </div>
    </form>
</section>
