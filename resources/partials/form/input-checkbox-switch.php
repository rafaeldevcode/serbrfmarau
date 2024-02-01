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

    $checked = (!isset($value) || $value == 'off') ? '' : 'checked';
    
    if(isset($invert_value) && $invert_value):
        $checked = $checked == 'checked' ? '' : 'checked';
    endif; 
?>

<label class="relative inline-flex items-center my-3 pointer">
    <input 
        type="checkbox" 
        class="sr-only peer" 
        id='<?php echo $name ?>' 
        name='<?php echo $name ?>' 
        <?php echo $checked ?> 
        <?php echo $attr ?>
    >
    
    <div class="w-11 h-6 bg-secondary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-secondary after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-color-main"></div>
    <span class="ml-3 text-sm font-medium text-secondary"><?php echo $label ?><span class="text-danger"><?php echo $is_required ?></span></span>

    <span class='absolute right-0 bottom-0 validit'></span>
</label>
