<?php
    verifyMethod(500, 'POST');

    use Src\Models\Category;

    $category = new Category();
    $requests = requests();
    $message = 'Categoria(s) removida(s) com sucesso!';
    $type = 'success';

    foreach($requests->ids as $ID):
        $category = $category->find($ID);
        
        if($category->locations()->data):
            $message = 'Categorias que estão vinculadas à algum local, não podem ser removidas!';
            $type = 'info';
        else:
            $category->delete();
        endif;
    endforeach;

    session([
        'message' => $message,
        'type' => $type
    ]);

    return header(route('/admin/categories', true), true, 302);
