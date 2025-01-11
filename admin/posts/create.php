<?php
    verifyMethod(500, 'POST');
    
    use Src\Models\Gallery;
    use Src\Models\Posts;

    $requests = requests();
    $post = new Posts();
    $gallery = new Gallery();

    $slug = normalizeSlug($requests->title, $requests->slug);
    $thumbnail = !empty($requests->thumbnail) ? $requests->thumbnail : null;
    $collection = isset($requests->collection) ? $requests->collection : null;
    $show_home = isset($requests->show_home) ? $requests->show_home : 'off';

    if(is_null($post->where('slug', '=', $slug)->first())):  
        $new_post = $post->create([
            'content' => $requests->content,
            'excerpt' => getExcerpt($requests->content),
            'title' => $requests->title,
            'status' => $requests->status,
            'category_id' => $requests->category_id,
            'slug' => $slug,
            'show_home' => $show_home,
            'user_id' => $_SESSION['user_id'],
            'thumbnail' => $thumbnail
        ]);

        $post->find($new_post->id)->images()->sync($collection);
        
        session([
            'message' => 'Post adicionado com sucesso!',
            'type'    => 'success'
        ]);
        
        return header(route('/admin/posts', true), true, 302);
    else:
        session([
            'message' => 'A slug já está sendo utilizada, por favor tente outra!',
            'type'    => 'danger'
        ]);
        
        return header(route('/admin/posts?method=create', true), true, 302);
    endif;
