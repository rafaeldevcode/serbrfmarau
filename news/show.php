<?php

    use Src\Models\Gallery;
    use Src\Models\Posts;

    $post_model = new Posts();
    $gallery = new Gallery();
    $requests = requests();
    $slug = slug(2);

    $post = $post_model->where('status', '=', 'published')->where('slug', '=', $slug)->first();

    if(isset($post)):
        $image = $gallery->find($post->thumbnail)->data;
        $image = isset($image->file) ? asset("assets/images/{$image->file}", true) : SETTINGS['site_logo_main'];
        $images = $post_model->find($post->id)->images();
        
        loadHtml(__DIR__.'/../resources/client/layout', [
            'title' => $post->title,
            'type' => 'article',
            'description' => $post->excerpt,
            'image' => $image,
            'body' => __DIR__."/body/show-body",
            'data' => ['post' => $post, 'images' => $images->data],
            'plugins' => ['slick'],
        ]);
    else:
        abort(404, 'Not Found', 'danger');
    endif;

    function loadInFooter() 
    { ?>
        <script type="text/javascript" src="<?php asset('libs/jquery/jquery.mask.min.js?ver='.APP_VERSION)?>"></script>
        <script type="text/javascript" src="<?php asset('assets/scripts/class/Gallery.js?ver='.APP_VERSION) ?>"></script>
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

            const gallery = new Gallery();
    
            gallery.oneClickPreview();
        </script>
    <?php }
