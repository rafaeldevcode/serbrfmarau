<section class="w-full h-[500px] md:h-[800px]" style="background: url(<?php asset("assets/images/{$image}") ?>) no-repeat center; background-size: cover;">
    <div class="bg-[#00000085] w-full h-full flex-col p-4 flex justify-center">
        <div class="max-w-[500px]">
            <h1 class="text-white font-bold text-5xl"><?php echo isset($title) ? $title : null ?></h1>

            <?php if(isset($text)): ?>
                <a href="<?php route($link) ?>" class="btn-color-main text-center py-3 rounded max-w-[300px] mt-4 px-6 text-2xl font-bold block mx-auto" title="<?php echo $text ?>"><?php echo $text ?></a>
            <?php endif ?>
        </div>
    </div>
</section>
