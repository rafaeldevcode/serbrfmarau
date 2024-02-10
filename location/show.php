<?php

    use Src\Models\Location;

    verifyMethod(405, 'GET');

    $location = new Location();
    $location = $location->find(slug(2));

    if(is_null($location->data)) abort(404, 'Location not found!', 'danger');

    $images = $location->images();

    loadHtml(__DIR__.'/../resources/client/layout', [
        'title' => "Local - {$location->data->name}",
        'body' => __DIR__ . '/body/read',
        'plugins' => ['slick'],
        'data' => [
            'location' => $location->data,
            'images' => $images->data
        ]
    ]);

    function loadInFooter() 
    { ?>
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
        </script>
    <?php }
