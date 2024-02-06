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

    <label class="relative block">
        <span class="sr-only">
            <?php echo $label.$is_required ?>
        </span>

        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
            <?php if(isset($icon)): ?>
                <i class='<?php echo $icon ?> absolute mr-2 my-2 ml-1 text-secondary'></i>
            <?php endif; ?>
        </span>

        <input 
            class="placeholder:italic placeholder:text-secondary block bg-white w-full border border-secondary rounded py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-color-main focus:ring-color-main focus:ring-1 sm:text-sm" 
            placeholder="<?php echo $label.$is_required ?>" 
            type="<?php echo $type ?>" 
            name="<?php echo $name ?>"
            id="<?php echo $name ?>"
            value="<?php echo isset($value) ? $value : '' ?>"
            <?php echo $attr ?>
        />

        <?php if($type === 'password'): ?>
            <button type='button' data-id-pass="show-pass" title='Exibir senha' class='btn-color-main btn-show-pass px-1 rounded-r absolute top-0 right-0 h-full'>
                <i class='bi bi-eye-fill'></i>
            </button>
        <?php endif; ?>

        <span class='absolute right-0 bottom-0 validit'></span>
    </label>
</div>
