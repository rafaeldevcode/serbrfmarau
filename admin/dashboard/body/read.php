<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <div class="p-2">
        <h2 class="mb-2 text-3xl font-bold tracking-tight text-color-main border-b pb-2">Hoje</h2>

        <div class="w-[360px] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 pointer">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Totais de reservas para hoje</h5>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-color-main text-end"><?php echo $today_reservations ?> <?php echo $today_reservations > 1 ? 'reservas' : 'reserva' ?></h5>
        </div>
    </div>

    <div class="p-2">
        <h2 class="mb-2 text-3xl font-bold tracking-tight text-color-main border-b pb-2">Locais</h2>

        <div class="flex items-start flex-wrap gap-4">
            <?php foreach($location_reservations as $reservation): ?>
                <div class="w-[360px] p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 pointer">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?php echo $reservation['location'] ?></h5>
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-color-main text-end"><?php echo $reservation['count'] ?> <?php echo $reservation['count'] > 1 ? 'reservas' : 'reserva' ?></h5>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
