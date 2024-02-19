<?php
    verifyMethod(500, 'POST');

    use Src\Models\Gallery;

    $gallery = new Gallery();
    $message = 'Image(s) removida(s) com sucesso!';
    $type = 'success';

    foreach(requests()->ids as $id):
        $image = $gallery->find($id);

        if($image->categories()->data):
            $message = 'Algumas imagens não foram removidas por estarem vinculadas a alguma categoria!';
            $type = 'info';
        else:
            $image->locations()->detach($id);
            $image->delete();
            isset($image->data) && deleteDir(__DIR__."/../../public/assets/images/{$image->data->file}");
        endif;
    endforeach;

    session([
        'message' => $message,
        'type' => $type
    ]);

    return header(route('/admin/gallery', true), true, 302);
