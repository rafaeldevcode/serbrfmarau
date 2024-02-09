<header class="bg-white sticky top-0 shadow-lg p-4 z-[10]">
    <section class="container flex flex-row justify-between">
        <div class="flex items-center">
            <div class="h-[40px] mr-4">
                <a href="<?php route('/') ?>" title="<?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>">
                    <img class="h-full" src="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_logo_main']) ? asset('assets/images/'.SETTINGS['site_logo_main'].'') : asset('assets/images/logo_main.png') ?>" alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>">
                </a>
            </div>

            <p class="text-xl text-secondary font-bold hidden md:block"><?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?></p>
        </div>

        <div id="menu-client" class="hidden md:flex flex-col md:flex-row items-start md:items-center gap-4 fixed bg-white md:relative md:top-0 md:right-0 top-20 right-2 rounded p-4 md:p-0">
            <nav>
                <ul class="flex flex-col md:flex-row gap-4 items-start md:items-center">
                    <li>
                        <a href="<?php route('/') ?>" class="text-secondary font-bold hover:text-color-main" title="Inicio">Inicio</a>
                    </li>

                    <li>
                        <a href="<?php route('/schedules') ?>" class="text-secondary font-bold hover:text-color-main" title="Agendamentos">Agendamentos</a>
                    </li>
                </ul>
            </nav>

            <ul class="flex items-center gap-4">
                <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_facebook'])): ?>
                    <li>
                        <a href="<?php echo SETTINGS['profile_facebook'] ?>" class="text-secondary hover:text-color-main" target="_blank" rel="noopener" title="Facebook">
                            <i class="bi bi-facebook text-2xl"></i>
                        </a>
                    </li>
                <?php endif ?>

                <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_instagram'])): ?>
                    <li>
                        <a href="<?php echo SETTINGS['profile_instagram'] ?>" class="text-secondary hover:text-color-main" target="_blank" rel="noopener" title="Instagram">
                            <i class="bi bi-instagram text-2xl"></i>
                        </a>
                    </li>
                <?php endif ?>

                <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_linkedin'])): ?>
                    <li>
                        <a href="<?php echo SETTINGS['profile_linkedin'] ?>" class="text-secondary hover:text-color-main" target="_blank" rel="noopener" title="Linkedin">
                            <i class="bi bi-linkedin text-2xl"></i>
                        </a>
                    </li>
                <?php endif ?>

                <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_twitter'])): ?>
                    <li>
                        <a href="<?php echo SETTINGS['profile_twitter'] ?>" class="text-secondary hover:text-color-main" target="_blank" rel="noopener" title="Nosso perfil no twitter">
                            <i class="bi bi-twitter text-2xl"></i>
                        </a>
                    </li>
                <?php endif ?>

                <?php if(!is_null(SETTINGS) && !empty(SETTINGS['telegram'])): ?>
                    <li>
                        <a href="https://t.me/<?php echo SETTINGS['telegram'] ?>?text=<?php echo SETTINGS['telegram_message'] ?>" class="text-secondary hover:text-color-main" target="_blank" rel="noopener" title="Contate nos via telegram">
                            <i class="bi bi-telegram text-2xl"></i>
                        </a>
                    </li>
                <?php endif ?>

                <?php if(!is_null(SETTINGS) && !empty(SETTINGS['whatsapp'])): ?>
                    <li>
                        <a href="https://wa.me/+<?php echo preg_replace('/[^0-9]/', '', SETTINGS['whatsapp']) ?>?text=<?php echo SETTINGS['whatsapp_message'] ?>" class="text-secondary hover:text-color-main" title="WhatsApp" target="_blank" rel="noopener">
                            <i class="bi bi-whatsapp text-2xl"></i>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </div>

        <button id="button-menu-client" data-menu="close" class="border-none bg-transparent block md:hidden">
            <i class="bi bi-list text-4xl"></i>
        </button>
    </section>
</header>
