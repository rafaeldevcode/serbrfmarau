<?php 
    $is_required = null;
    $attr = null;

    if(isset($attributes)):
        if(is_array($attributes)):
            foreach($attributes as $indice => $attribute):
                $attr .= "{$indice}={$attribute} ";
                $is_required = $indice == 'required' ? '*' : null;
            endforeach;
        else:
            $attr = $attributes;
            $is_required = $attributes == 'required' ? '*' : null;
        endif;
    endif;
?>

<div class="my-3">
    <label class="text-secondary text-sm font-bold" for="<?php echo $name ?>"><?php echo $label ?><span class="text-danger"><?php echo $is_required ?></span></label>

    <div class='flex flex-col relative'>
        <?php if(isset($icon)): ?>
            <i class='<?php echo $icon ?> absolute m-2 text-secondary'></i>
        <?php endif; ?>

        <textarea 
            rows="4"
            <?php echo $attr ?>
            id="<?php echo $name ?>" 
            name="<?php echo $name ?>" 
            placeholder="<?php echo $label.$is_required ?>"
            class="pl-8 placeholder:italic placeholder:text-secondary block p-2 w-full text-sm text-secondary rounded border border-secondary shadow-sm focus:outline-none focus:border-color-main focus:ring-color-main focus:ring-1" 
        ><?php echo isset($value) ? $value : '' ?></textarea>
            
        <span class='absolute right-0 bottom-0 validit'></span>
    </div>
</div>
