<?php
    verifyMethod(500, 'POST');

    use Src\Models\Category;

    $requests = requests();

    $category = new Category();

    $category->create([
        'name' => $requests->name,
        'description' => $requests->description,
        'thumbnail' => $requests->thumbnail
    ]);

    session([
        'message' => 'Categoria adicionado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/categories', true), true, 302);
