<section 
    class="w-full h-[500px] md:h-[700px]" 
    data-mobile="<?php asset("assets/images/{$mobile}") ?>" 
    data-desktop="<?php asset("assets/images/{$desktop}") ?>"
    data-carousel="item"
    style="background: url(<?php asset("assets/images/{$desktop}") ?>) no-repeat center; background-size: cover;"
>

    <a href="<?php echo $link ?>">
        <div class="bg-[#00000085] w-full h-full flex-col p-4 flex">
            <div class="w-full">
                <h2 class="text-white font-bold text-5xl text-center"><?php echo isset($title) ? $title : null ?></h2>
                <h3 class="text-white text-center text-xl"><?php echo isset($subtitle) ? $subtitle : null ?></h3>
            </div>
        </div>
    </a>
</section>
