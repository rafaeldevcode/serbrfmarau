<div data-modal="payments" class="z-[99999] fixed top-0 left-0 w-full h-full items-center justify-center hidden z-50">
    <div class="bg-white rounded w-full max-w-[500px]" data-modal-body="popup">
        <div class="p-4 relative bg-color-main rounded-t">
            <button data-modal-close="popup" type="button" title="Fechar modal" class="absolute top-0 right-2 text-white hover:text-gray-800 w-[20px] opacity-50">
                <i class="bi bi-x text-2xl"></i>
            </button>

            <h2 class="font-bold text-white p-2 rounded text-center" id="modalDeleteItemLabel">Pagamentos</h2>
        </div>

        <form class="p-4">
            <div class='w-full h-[450px] overflow-x-auto' data-list="payments"></div>

            <div class="flex justify-end space-x-2 mt-4">
                <button data-modal-close="popup" type="button" title="Fechar" class="btn btn-secondary font-bold">
                    Fechar
                </button>
            </div>
        </form>
    </div>
</div>
