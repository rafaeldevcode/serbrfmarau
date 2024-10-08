<?php loadHtml(__DIR__ . '/../resources/client/partials/block-one', [
    'image' => !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? SETTINGS['site_bg_login'] : 'login_bg.jpg',
    'title' => !is_null(SETTINGS) && !empty(SETTINGS['site_description']) ? SETTINGS['site_description'] : '',
    'text' => 'Agendamentos',
    'link' => '/schedules'
]) ?>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../resources/client/partials/title', [
            'title' => 'Quem Somos',
        ]) ?>

        <div class="flex flex-wrap items-center mt-12">
            <div class="w-full md:w-6/12 font-semibold text-gray-800 text-xl pr-2">
                <p class="mb-6">Bem-vindo à <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>, um espaço multifuncional para tornar cada momento único e inesquecível. Com uma vasta gama de opções de lazer, incluindo, parque infantil, campos, quadras esportivas, cancha de bocha, academia, casas, quiosques e salões de festas. Local ideal para celebrações, eventos sociais e esportivos, local com amplo estacionamento.</p>
                <p>Seja para celebrações sociais, eventos esportivos ou momentos de lazer, a <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?> está comprometida em proporcionar uma experiência especial a todos que frequentarem nossas instalações. Venha fazer parte da nossa história e desfrute de um espaço que une diversão e bem-estar.</p>
            </div>

            <div class="w-full md:w-6/12 pl-2">
                <ul>
                    <?php foreach($categories as $indice => $category): ?>
                        <li class="flex items-center gap-4 mb-4">
                            <i class="bi bi-<?php echo $indice+1 ?>-circle-fill text-5xl text-color-main"></i>

                            <div>
                                <p class="font-bold text-color-main"><?php echo $category->name ?></p>
                                <p><?php echo $category->description ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="px-4 py-8 bg-gray-200">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../resources/client/partials/title', [
            'title' => 'Nossos Locais',
        ]) ?>

        <div class="flex flex-wrap items-center justify-center mt-12">
            <?php loadHtml(__DIR__ . '/../resources/client/partials/card-categories', [
                'categories' => $categories
            ]) ?>
        </div>
    </div>
</section>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../resources/client/partials/title', [
            'title' => 'Entre em Contato',
            'subtitle' => 'Conecte-se Conosco: Estamos Aqui para Atender às suas Necessidades e Responder às suas Perguntas'
        ]) ?>

        <div class="max-w-[800px] mx-auto mt-12">
            <form action="<?php route('/contact/create') ?>" method="POST">
                <div class='flex justify-between flex-wrap'>
                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/../resources/partials/form/input-default', [
                            'icon' => 'bi bi-person-fill',
                            'name' => 'name',
                            'label' => 'Nome',
                            'type' => 'text',
                            'attributes' => 'required'
                        ]) ?>
                    </div>

                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/../resources/partials/form/input-default', [
                            'icon' => 'bi bi-envelope-fill',
                            'name' => 'email',
                            'label' => 'Email',
                            'type' => 'email',
                            'attributes' => 'required'
                        ]) ?>
                    </div>

                    <div class='w-full px-4'>
                        <?php loadHtml(__DIR__.'/../resources/partials/form/text-area', [
                            'icon' => 'bi bi-card-text',
                            'name' => 'message',
                            'label' => 'Sua mensagem',
                            'attributes' => 'required'
                        ]) ?>
                    </div>
                </div>

                <div class='flex justify-end px-4'>
                    <?php loadHtml(__DIR__.'/../resources/partials/form/input-button', [
                        'type' => 'submit',
                        'style' => 'color-main',
                        'title' => 'Enviar',
                        'value' => 'Enviar'
                    ]) ?>
                </div>
            </form>
        </div>
    </div>
</section>

<?php if(!is_null(SETTINGS) && !empty(SETTINGS['map_location'])): ?>
    <section class="px-4 py-8 bg-gray-200">
        <div class="container">
            <?php loadHtml(__DIR__ . '/../resources/client/partials/title', [
                'title' => 'Onde Estamos',
                'subtitle' => 'Encontre-nos no Mapa: Descubra Como Chegar até Nós e Explore Nossa Localização Privilegiada'
            ]) ?>

            <div class="flex flex-wrap items-center justify-center mt-12">
                <iframe 
                    class="bg-white p-2"
                    src="<?php echo SETTINGS['map_location'] ?>" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>
<?php endif ?>
