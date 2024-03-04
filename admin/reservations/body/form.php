<section class='p-3 bg-light m-0 sm:m-3 rounded shadow-lg'>
    <?php loadHtml(__DIR__.'/../../../resources/partials/hours-available', [
        'reservation' => $reservation,
        'locations' => $locations,
        'is_admin' => true,
        'route' => $action
    ]) ?>
</section>
