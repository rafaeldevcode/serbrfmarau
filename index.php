<?php

    use Src\Models\Banners;
    use Src\Models\Category;
    use Src\Models\Posts;

    verifyMethod(405, 'GET');

    $category = new Category();
    $post = new Posts();
    $banner = new Banners();
    $categories = $category->where('type', '=', 'Locais')->get();
    $posts = $post->where('status', '=', 'published')->where('show_home', '=', 'on')->paginate(2); 
    $banners = $banner->where('status', '=', 'on')->get();

    loadHtml(__DIR__.'/resources/client/layout', [
        'title' => 'Inicio',
        'body' => __DIR__ . '/body/read',
        'plugins' => ['slick'],
        'data' => [
            'categories' => $categories,
            'posts' => $posts,
            'banners' => $banners
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

            const width = window.innerWidth;
            const carouselItems = $('[data-carousel="item"]');

            carouselItems.each((index, item) => {
                const mobile = $(item).attr('data-mobile');
                const desktop = $(item).attr('data-desktop');

                if (width < 768) {
                    $(item).attr('style', `background: url(${mobile}) no-repeat center; background-size: cover;`);
                } else {
                    $(item).attr('style', `background: url(${desktop}) no-repeat center; background-size: cover;`);
                }
            })
        </script>
    <?php }
