<footer class="p-4 bg-color-main">
    <section class="flex flex-col justify-center items-center gap-4">
        <nav>
            <ul class="flex items-center gap-4">
                <li>
                    <a href="<?php route('/') ?>" class="text-white hover:text-secondary font-bold text-xl" title="Inicio">Inicio</a>
                </li>

                <li>
                    <a href="<?php route('/agendamentos') ?>" class="text-white hover:text-secondary font-bold text-xl" title="Agendamentos">Agendamentos</a>
                </li>
            </ul>
        </nav>

        <ul class="flex items-center gap-4">
            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_facebook'])): ?>
                <li>
                    <a href="<?php echo SETTINGS['profile_facebook'] ?>" class="text-white hover:text-secondary" target="_blank" rel="noopener" title="Facebook">
                        <i class="bi bi-facebook text-2xl"></i>
                    </a>
                </li>
            <?php endif ?>

            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_instagram'])): ?>
                <li>
                    <a href="<?php echo SETTINGS['profile_instagram'] ?>" class="text-white hover:text-secondary" target="_blank" rel="noopener" title="Instagram">
                        <i class="bi bi-instagram text-2xl"></i>
                    </a>
                </li>
            <?php endif ?>

            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_linkedin'])): ?>
                <li>
                    <a href="<?php echo SETTINGS['profile_linkedin'] ?>" class="text-white hover:text-secondary" target="_blank" rel="noopener" title="Linkedin">
                        <i class="bi bi-linkedin text-2xl"></i>
                    </a>
                </li>
            <?php endif ?>

            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['profile_twitter'])): ?>
                <li>
                    <a href="<?php echo SETTINGS['profile_twitter'] ?>" class="text-white hover:text-secondary" target="_blank" rel="noopener" title="Nosso perfil no twitter">
                        <i class="bi bi-twitter text-2xl"></i>
                    </a>
                </li>
            <?php endif ?>

            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['telegram'])): ?>
                <li>
                    <a href="https://t.me/<?php echo SETTINGS['telegram'] ?>?text=<?php echo SETTINGS['telegram_message'] ?>" class="text-white hover:text-secondary" target="_blank" rel="noopener" title="Contate nos via telegram">
                        <i class="bi bi-telegram text-2xl"></i>
                    </a>
                </li>
            <?php endif ?>

            <?php if(!is_null(SETTINGS) && !empty(SETTINGS['whatsapp'])): ?>
                <li>
                    <a href="https://wa.me/+<?php echo preg_replace('/[^0-9]/', '', SETTINGS['whatsapp']) ?>?text=<?php echo SETTINGS['whatsapp_message'] ?>" class="text-white hover:text-secondary" title="WhatsApp" target="_blank" rel="noopener">
                        <i class="bi bi-whatsapp text-2xl"></i>
                    </a>
                </li>
            <?php endif ?>
        </ul>

        <p class="text-white"><?php echo !is_null(SETTINGS) && !empty(SETTINGS['copyright']) ? SETTINGS['copyright'] : '' ?></p>
    </section>
</footer>
