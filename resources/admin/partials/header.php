<header class='bg-color-main flex items-center w-full p-2 shadow-xl header'>
    <div class='flex justify-between items-center w-full'>
        <div class='flex items-center'>
            <form id='menu' class='menu'>
                <input class='hidden menu_input' type='checkbox' id='checkbox-menu'>

                <label class='relative block ml-2 menu_label' for="checkbox-menu">
                    <span class='absolute block rounded bg-light'>.</span>
                    <span class='absolute block rounded bg-light'>.</span>
                    <span class='absolute block rounded bg-light'>.</span>
                </label>
            </form>
        </div>

        <div class='flex items-center flex-nowrap'>
            <div class='logo-header w-auto my-auto'>
                <a href='<?php route('/admin/dashboard') ?>' title='Voltar a página inicial'>
                    <img class='h-full' src='<?php !is_null(SETTINGS) && !empty(SETTINGS['site_logo_main']) ? asset('assets/images/'.SETTINGS['site_logo_secondary'].'') : asset('assets/images/logo_secondary.png') ?>' alt="Logo <?php echo !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : env('APP_NAME') ?>" />
                </a>
            </div>
        </div>
    </div>
</header>
