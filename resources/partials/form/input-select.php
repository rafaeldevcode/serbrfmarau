<?php 
    $values = is_array($value) ? $value : [$value];
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

<div class='flex flex-col <?php echo isset($label) ? 'my-3' : '' ?>'>
    <?php if (isset($label)): ?>
        <label for="<?php echo $name ?>" class="block mb-1 text-sm font-bold text-secondary">
            <?php echo $label ?>
            <span class="text-danger"><?php echo $is_required ?></span>
        </label>
    <?php endif ?>

    <div class="relative">
        <?php if(isset($icon)): ?>
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <i class='<?php echo $icon ?> absolute mr-2 my-2 ml-1 text-secondary'></i>
            </span>
        <?php endif; ?>

        <select 
            id="<?php echo $name ?>"
            name="<?php echo $name ?>"
            <?php echo $attr ?>
            class="<?php echo isset($icon) ? 'ps-8' : '' ?> shadow-sm italic border bg-white focus:outline-none border-secondary text-secondary text-sm rounded focus:ring-color-main focus:ring-1 focus:border-color-main block w-full py-2"
        >
            <?php foreach($array as $indice => $item): ?>
                <option value='<?php echo $indice ?>' <?php echo isset($value) && in_array($indice, $values) ? 'selected' : '' ?>><?php echo $item ?></option>
            <?php endforeach ?>
        </select>

        <span class='absolute right-0 bottom-0 validit'></span>
    </div>
</div>
