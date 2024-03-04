<section class='p-3'>
    <div class='border-b flex justify-between flex-col md:flex-row items-start md:items-end'>
        <div>
            <div class="breadcrumps-overflow">
                <ul class='p-0 flex flex-nowrap text-secondary'>
                    <li class='mr-2'><span class='<?php echo $background ?> rounded text-white font-bold text-xs py-1 px-2'><?php echo $type ?></span></li>

                    <?php foreach(normalizeBreadcrumps() as $breadcrump): ?>
                        <li class='mx-2'>
                            <a title="Breadcrumps item" class='text-secondary bg-gray-200 rounded-full text-xs py-1 px-3 block font-bold' href='<?php route($breadcrump['path']) ?>'><?php echo $breadcrump['title'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class='flex frex-nowrap my-2 items-center'>
                <button type='button' id='back' title='Voltar a página anterior' class='rounded py-2 px-1 btn-color-main mr-1 text-light'>
                    <i class="bi bi-arrow-bar-left text-2xl"></i>
                </button>
                
                <span class='bg-color-main rounded p-2 mr-1'>
                    <i class='<?php echo $icon ?> text-light text-2xl'></i>
                </span>

                <p class='text-3xl font-bold text-secondary'><?php echo $title ?></p>
            </div>
        </div>

        <div class='flex mb-2 mx-auto md:mx-0'>
            <div class='flex flex-col sm:flex-row space-y-2 sm:space-y-0 justify-center'>
                <div class="mx-1">
                    <?php if(isset($route_search)): ?>
                        <?php loadHtml(__DIR__.'/../../partials/form/input-search', ['route' => $route_search]) ?>
                    <?php endif; ?>
                </div>

                <div class="flex justify-center sm:justify-end">
                    <?php if(isset($route_delete)): ?>
                        <button data-button="delete-several" id='deleteAll' type='button' title='Remover vários(a) <?php echo $title ?>' class='btn text-xs font-bold btn-danger mx-1 text-light' data-route='<?php route($route_delete) ?>' disabled>
                            Remover
                        </button>
                    <?php endif; ?>

                    <?php if(isset($route_add)): ?>
                        <a href='<?php route($route_add) ?>' title='Adicionar <?php echo $title ?>' class='text-xs btn btn-primary font-bold mx-1 text-center'>Adicionar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($sub_options)): ?>
        <div class="bg-secondary">
            <?php loadHtml($sub_options) ?>
        </div>
    <?php endif; ?>
</section>
