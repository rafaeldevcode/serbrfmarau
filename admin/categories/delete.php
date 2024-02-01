<?php
    verifyMethod(500, 'POST');

    use Src\Models\Category;

    $category = new Category();
    $requests = requests();

    foreach($requests->ids as $ID):
        $category->find($ID)->delete();
    endforeach;

    session([
        'message' => 'Categoria(s) removida(s) com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/categories', true), true, 302);
