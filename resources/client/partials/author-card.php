<?php

    use Src\Models\User;

    $author = new User();
    $author = $author->find($id)->data;
?>

<div class="border border-gray-300 my-6 rounded p-4 flex justify-between items-start">
    <div class="flex items-start">
        <div class='user mr-4'>
            <img class='w-100' src='<?php asset("assets/images/users/{$author->avatar}") ?>' alt='<?php echo $author->name ?>'>
        </div>

        <div class="whitespace-nowrap">
            <p class="text-gray-500">Por <span class="font-semibold uppercase"><?php echo $author->name ?></span></p>
            <p class="text-xs text-gray-500"><?php echo date('d/m/Y', strtotime($created)) ?></p>
        </div>
    </div>
</div>
