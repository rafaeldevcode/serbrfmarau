<div data-modal="filter" class="z-[99999] fixed top-0 left-0 w-full h-full items-center justify-center hidden z-50">
    <div class="bg-white rounded w-full max-w-[500px]" data-modal-body="popup">
        <div class="px-4 py-2 relative bg-danger rounded-t">
            <button data-modal-close="popup" type="button" title="Fechar modal" class="absolute top-0 right-2 text-white hover:text-gray-800 w-[20px] opacity-50">
                <i class="bi bi-x text-2xl"></i>
            </button>

            <h2 class="font-bold text-white p-2 rounded text-center" id="modalDeleteItemLabel">Filtrar reservas</h2>
        </div>

        <form action="" method="POST" class="p-4">
            <div class='w-full'>
                <?php if(isset(requests()->search)): ?>
                    <input type="hidden" name="search" value="<?php echo requests()->search ?>">
                <?php endif ?>

                <?php loadHtml(__DIR__.'/../../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'status',
                    'label' => 'Status',
                    'value' => isset(requests()->status) ? requests()->status : null,
                    'array' => [
                        '' => '----',
                        'Pendente' => 'Pendente',
                        'Aprovado' => 'Aprovado',
                        'Reprovado' => 'Reprovado',
                        'Finalizado' => 'Finalizado'
                    ]
                ]) ?>

                <?php loadHtml(__DIR__.'/../../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'reservation_type',
                    'label' => 'Tipo',
                    'value' => isset(requests()->reservation_type) ? requests()->reservation_type : null,
                    'array' => [
                        '' => '----',
                        'Fixo' => 'Fixo',
                        'Normal' => 'Normal'
                    ]
                ]) ?>

                <?php loadHtml(__DIR__.'/../../../../resources/partials/form/input-select', [
                    'icon' => 'bi bi-hash',
                    'name' => 'date',
                    'label' => 'Data da reserva',
                    'value' => isset(requests()->date) ? requests()->date : null,
                    'array' => [
                        '' => '----',
                        'P1D' => 'Hoje',
                        'P1W' => 'Essa semana',
                        'P1M' => 'Esse mês',
                        'P1Y' => 'Esse ano'
                    ]
                ]) ?>
            </div>

            <div class="flex justify-end space-x-2">
                <button data-modal-close="popup" type="button" title="Fechar" class="btn btn-secondary font-bold">
                    Fechar
                </button>

                <button type="submit" title="Filtrar" class="btn btn-color-main font-bold">
                    Filtrar
                </button>
            </div>
        </form>
    </div>
</div>
