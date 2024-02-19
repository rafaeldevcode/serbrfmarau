<div data-modal="search-user" class="z-[99999] fixed top-0 left-0 w-full h-full items-center justify-center hidden z-50">
    <div class="bg-white rounded w-full max-w-[500px]" data-modal-body="popup">
        <div class="p-4 relative bg-color-main rounded-t">
            <button data-modal-close="popup" type="button" title="Fechar modal" class="absolute top-0 right-2 text-white hover:text-gray-800 w-[20px] opacity-50">
                <i class="bi bi-x text-2xl"></i>
            </button>

            <h2 class="font-bold text-white p-2 rounded text-center">Insira seu email para iniciar o agendamento</h2>
        </div>

        <form class="p-4" action="<?php route('/location') ?>" method="GET">
            <input type="hidden" name="location" value="<?php echo $location_id ?>">
            
            <section>
                <div class="w-full flex justify-between">
                    <div class='w-full px-2'>
                        <?php loadHtml(__DIR__.'/../../../resources/partials/form/input-default', [
                            'icon' => 'bi bi-envelope-fill',
                            'name' => 'email',
                            'label' => 'Insira seu email',
                            'type' => 'email',
                            'value' => '',
                            'attributes' => 'required'
                        ]) ?>
                    </div>
                </div>
            </section>

            <div class="flex justify-end space-x-2 mt-4">
                <button data-modal-close="popup" type="button" class="btn btn-secondary font-bold">
                    Fechar
                </button>

                <button data-modal-close="popup" type="submit" class="btn btn-color-main font-bold">
                    Enviar
                </button>
            </div>
        </form>
    </div>
</div>
