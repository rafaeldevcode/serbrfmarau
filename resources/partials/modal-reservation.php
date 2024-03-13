<div data-modal="reservation" class="z-[99999] fixed top-0 left-0 w-full h-full items-center justify-center hidden z-50">
    <div class="bg-white rounded w-full max-w-[800px] relative" data-modal-body="popup">
        <?php loadHtml(__DIR__.'/preloader', ['position' => 'absolute', 'type' => 'reservation']) ?>

        <div class="p-4 relative bg-color-main rounded-t">
            <button data-modal-close="popup" type="button" title="Fechar modal" class="absolute top-0 right-2 text-white hover:text-gray-800 w-[20px] opacity-50">
                <i class="bi bi-x text-2xl"></i>
            </button>

            <h2 class="font-bold text-white p-2 rounded text-center">Informações adicionais</h2>
        </div>

        <div class="p-4">
            <section class="w-full">
                <div class='flex justify-between flex-wrap'>
                    <div class='w-full px-4'>
                        <?php loadHtml(__DIR__.'/form/input-default', [
                            'icon' => 'bi bi-alphabet-uppercase',
                            'name' => 'name',
                            'label' => 'Nome da reserva',
                            'type' => 'text',
                            'value' => isset($reservation) ? $reservation->name : null,
                            'attributes' => 'required'
                        ]) ?>
                    </div>
                </div>

                <div class='flex flex-wrap'>
                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/form/input-default', [
                            'icon' => 'bi bi-envelope-fill',
                            'name' => 'email',
                            'label' => 'Email',
                            'type' => 'text',
                            'value' => isset($reservation) ? $reservation->email : null,
                            'attributes' => 'required'
                        ]) ?>
                    </div>

                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/form/input-default', [
                            'icon' => 'bi bi-telephone-fill',
                            'name' => 'phone',
                            'label' => 'Telefone',
                            'type' => 'text',
                            'value' => isset($reservation) ? $reservation->phone : null,
                            'attributes' => 'required'
                        ]) ?>
                    </div>

                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/form/input-default', [
                            'icon' => 'bi bi-123',
                            'name' => 'identifier',
                            'label' => $is_admin ? 'CPF / Identificado do cliente' : 'CPF',
                            'type' => 'text',
                            'value' => isset($reservation) ? $reservation->identifier : null,
                            'attributes' => 'required'
                        ]) ?>
                    </div>

                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/form/input-select', [
                            'icon' => 'bi bi-hash',
                            'name' => 'payment_type',
                            'label' => 'Tipo de pagamento',
                            'value' => isset($reservation) ? $reservation->payment_type : null,
                            'attributes' => 'required',
                            'array' => [
                                'Cartão de Crédito' => 'Cartão de Crédito',
                                'Cartão de Débito' => 'Cartão de Débito',
                                'Pix' => 'Pix',
                                'Dinheiro' => 'Dinheiro'
                            ]
                        ]) ?>
                    </div>

                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/form/input-default', [
                            'icon' => 'bi bi-people-fill',
                            'name' => 'amount_people',
                            'label' => 'Quantidade de Pessoas',
                            'type' => 'number',
                            'value' => isset($reservation) ? $reservation->amount_people : null,
                            'attributes' => 'required'
                        ]) ?>
                    </div>

                    <div class='w-full md:w-6/12 px-4'>
                        <?php loadHtml(__DIR__.'/form/input-select', [
                            'icon' => 'bi bi-hash',
                            'name' => 'event',
                            'label' => 'Evento',
                            'value' => isset($reservation) ? $reservation->event : null,
                            'attributes' => 'required',
                            'array' => [
                                'Aniversário' => 'Aniversário',
                                'Casamento' => 'Casamento',
                                'Formatura' => 'Formatura',
                                'Outros' => 'Outros'
                            ]
                        ]) ?>
                    </div>

                    <?php if($is_admin): ?>
                        <div class='w-full md:w-6/12 px-4'>
                            <?php loadHtml(__DIR__.'/form/input-select', [
                                'icon' => 'bi bi-hash',
                                'name' => 'status',
                                'label' => 'Status',
                                'value' => isset($reservation) ? $reservation->status : null,
                                'attributes' => 'required',
                                'array' => [
                                    'Pendente' => 'Pendente',
                                    'Aprovado' => 'Aprovado',
                                    'Reprovado' => 'Reprovado',
                                    'Finalizado' => 'Finalizado'
                                ]
                            ]) ?>
                        </div>
                    <?php endif ?>

                    <div class='w-full px-4'>
                        <?php loadHtml(__DIR__.'/form/text-area', [
                            'icon' => 'bi bi-card-text',
                            'name' => 'observation',
                            'label' => 'Observação (Descreva aqui caso o evento for "Outros")',
                            'value' => isset($reservation) ? $reservation->observation : null
                        ]) ?>
                    </div>
                </div>
            </section>

            <div class="flex justify-end space-x-2 mt-4">
                <button type="submit" title="Reservar horários" class="btn btn-color-main font-bold">
                    Reservar
                </button>
            </div>
        </div>
    </div>
</div>
