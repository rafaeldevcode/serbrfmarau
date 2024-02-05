<?php
    $attr = null;

    if(isset($attributes)):
        if(is_array($attributes)):
            foreach($attributes as $indice => $attribute):
                $attr .= "{$indice}={$attribute} ";
            endforeach;
        else:
            $attr = $attributes;
        endif;
    endif;
?>

<div class='flex flex-col my-3'>
    <button class='btn pointer btn-<?php echo $style ?> py-2 w-[200px] font-bold text-xl text-light' type="<?php echo $type ?>" title="<?php echo $title ?>" <?php echo $attr ?>>
        <?php echo $value ?>
    </button>
</div>
