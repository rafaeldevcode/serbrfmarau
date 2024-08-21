<div data-modal="prices-day" class="fixed top-0 left-0 w-full h-full items-center justify-center hidden z-[99999]">
    <div class="bg-white rounded w-full max-w-[500px]" data-modal-body="popup">
        <div class="p-4 relative bg-color-main rounded-t">
            <button data-modal-close="popup" type="button" title="Fechar modal" class="absolute top-0 right-2 text-white hover:text-gray-800 w-[20px] opacity-50">
                <i class="bi bi-x text-2xl"></i>
            </button>

            <h2 class="font-bold text-white p-2 rounded text-center">Selecionar preço por dia da semana (Dia cheio)</h2>
        </div>

        <div class="p-4">
            <section>
                <?php foreach(pickDaysOfTheWeek() as $day): ?>
                    <div class="w-full flex justify-between">
                        <div class='w-6/12 px-2'>
                            <?php loadHtml(__DIR__.'/../../../../resources/partials/form/input-default', [
                                'icon' => 'bi bi-alphabet-uppercase',
                                'name' => 'days[]',
                                'label' => 'Dia',
                                'type' => 'text',
                                'value' => $day,
                                'attributes' => 'disabled'
                            ]) ?>
                        </div>

                        <div class='w-3/12 px-2'>
                            <?php loadHtml(__DIR__.'/../../../../resources/partials/form/input-default', [
                                'icon' => 'bi bi-currency-dollar',
                                'name' => 'prices_partners[full][]',
                                'label' => 'Sócio',
                                'type' => 'text',
                                'value' => isset($days) ? $days['full'][$day][0] : null
                            ]) ?>
                        </div>

                        <div class='w-3/12 px-2'>
                            <?php loadHtml(__DIR__.'/../../../../resources/partials/form/input-default', [
                                'icon' => 'bi bi-currency-dollar',
                                'name' => 'prices[full][]',
                                'label' => 'Não Sócio',
                                'type' => 'text',
                                'value' => isset($days) ? $days['full'][$day][1] : null
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </section>

            <div class="flex justify-end space-x-2 mt-4">
                <button data-modal-close="popup" type="button" class="btn btn-color-main font-bold">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>
