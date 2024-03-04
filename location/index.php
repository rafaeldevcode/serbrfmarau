<?php
    verifyMethod(405, 'GET');

    use Src\Models\Location;

    $location = new Location();

    $requests = requests();

    if(is_null($requests->location)) abort(404, 'Location not found!', 'danger');

    $location = $location->find($requests->location);

    if(is_null($location->data)) abort(404, 'Location not found!', 'danger');

    $images = $location->images();

    loadHtml(__DIR__.'/../resources/client/layout', [
        'title' => "Local - {$location->data->name}",
        'body' => __DIR__.'/../location/body/read',
        'plugins' => ['slick'],
        'data' => [
            'location' => $location->data,
            'images' => $images->data
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
            hoursAvailable.getHours()
                .changeLocation()
                .changeDate()
                .changePeiod()
                .changeDay()
                .changeType()
                .submited();
        </script>
    <?php }
