<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <div class="flex justify-center items-center flex-wrap cm-browser-height border border-color-main rounded p-2">
        <div class="p-2 m-auto flex justify-center items-center w-full md:w-5/12">
            <img class="w-full" src="<?php !is_null(SETTINGS) && !empty(SETTINGS['site_logo_main']) ? asset('assets/images/'.SETTINGS['site_logo_main'].'') : asset('assets/images/logo_main.png') ?>" alt="Wellcome to dashboard">
        </div>
    </div>
</section>
