<section class="w-full h-[500px] md:h-[800px]" style="background: url(<?php !is_null(SETTINGS) && !empty(SETTINGS['site_bg_login']) ? asset('assets/images/'.SETTINGS['site_bg_login'].'') : asset('assets/images/login_bg.jpg') ?>) no-repeat; background-size: cover;">
    <div class="bg-[#00000085] w-full h-full flex-col p-4 flex justify-center">
        <div class="max-w-[500px]">
            <h1 class="text-white font-bold text-5xl"><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_description']) ? SETTINGS['site_description'] : '' ?></h1>

            <a href="<?php route('/agendamentos') ?>" class="btn-color-main text-center py-3 rounded max-w-[300px] mt-4 px-6 text-2xl font-bold block mx-auto" title="Agendamentos">Agendamentos</a>
        </div>
    </div>
</section>

<section class="px-4 py-8">
    <div class="container">
        <?php loadHtml(__DIR__ . '/../resources/client/partials/title', [
            'title' => 'Quem Somos',
            'subtitle' => 'Conheça a Nossa História: Paixão, Compromisso e Excelência'
        ]) ?>

        <div class="flex flex-wrap items-center mt-12">
            <div class="w-full md:w-6/12 font-semibold text-gray-800 text-xl pr-2">
                <p class="mb-6">Bem-vindo à <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>, onde a excelência e a diversão se encontram! Desde a nossa fundação, nos dedicamos a proporcionar experiências memoráveis e momentos inesquecíveis para nossos clientes. Com uma vasta gama de opções de lazer, incluindo campos, quadras esportivas, casas, quiosques e salões de festas, somos o destino ideal para celebrações, eventos esportivos e encontros sociais.</p>
                <p>Nossa equipe apaixonada e experiente está empenhada em oferecer um serviço impecável e instalações de alta qualidade para atender às necessidades de todos os nossos clientes. Seja você um amante dos esportes, um organizador de eventos ou alguém em busca de momentos de descontração, estamos aqui para tornar sua experiência conosco verdadeiramente especial.</p>
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
            'subtitle' => 'Conheça a Nossa História: Paixão, Compromisso e Excelência'
        ]) ?>

        <div class="flex flex-wrap items-center justify-center mt-12">
            <?php foreach($categories as $category): ?>
                <div class="p-2">
                    <a href="<?php route("/category/{$category->id}") ?>" class="block rounded w-[200px] h-[200px] relative hover:scale-105 transition duration-150 ease-in-out">
                        <?php loadHtml(__DIR__ . '/../resources/client/partials/thumbnail', [
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

<!-- relative after:content-[''] after:absolute after:top-0 after:left-0 after:w-full after:h-full after:bg-[#00000085] -->
