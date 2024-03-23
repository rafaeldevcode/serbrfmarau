<?php $width_height = $position == 'absolute' ? 'w-full h-full rounded' : 'w-screen h-screen' ?>

<section class="z-[99999] <?php echo $position ?> top-0 left-0 bg-light flex justify-center items-center <?php echo $width_height ?>" data-preloader="<?php echo $type ?>">
    <div class="w-[100px]">
        <img class="w-full" src="<?php asset('assets/images/preloaders/'.SETTINGS['preloader_image']) ?>" alt="Preloader">
    </div>
</section>
