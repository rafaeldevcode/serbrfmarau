<?php
    verifyMethod(405, 'GET');

    use Src\Models\Client;
    use Src\Models\Location;

    $location = new Location();
    $client = new Client();

    $requests = requests();

    if(is_null($requests->location)) abort(404, 'Location not found!', 'danger');

    $location = $location->find($requests->location);
    $client = $client->where('email', '=', $requests->email)->first();

    if(is_null($location->data)) abort(404, 'Location not found!', 'danger');

    $images = $location->images();

    loadHtml(__DIR__.'/../resources/client/layout', [
        'title' => "Local - {$location->data->name}",
        'body' => getBodySchedules($requests->email, $client),
        'plugins' => ['slick'],
        'data' => [
            'location' => $location->data,
            'client' => $client,
            'images' => $images->data,
            'email' => $requests->email
        ]
    ]);

    function loadInFooter() 
    { ?>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/HoursAvailable.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#carousel').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    dots: true,
                    infinite: true,
                    arrows: true,
                });
            });

            const hoursAvailable = new HoursAvailable();
            hoursAvailable.selectSeveralHours()
                .getHours()
                .changeLocation()
                .changeDate()
                .changePeiod()
                .changeDay()
                .changeType()
                .submited();

            $('[data-change="status"]').on('change', (event) => {
                $('#change-status').submit();
            });
        </script>
    <?php }