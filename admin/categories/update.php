<?php
    verifyMethod(500, 'POST');

    use Src\Models\Category;

    $requests = requests();

    $category = new Category();
    $category = $category->find($requests->id);

    $category->update([
        'name' => $requests->name,
        'description' => $requests->description,
        'type' => $requests->type,
        'thumbnail' => $requests->thumbnail
    ]);

    session([
        'message' => 'Categoria atualizada com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/categories', true), true, 302);
