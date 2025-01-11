<?php

    use Src\Models\Category;
    use Src\Models\Posts;

    verifyMethod(405, 'GET');

    $category = new Category();
    $post = new Posts();
    $categories = $category->where('type', '=', 'Locais')->get();
    $posts = $post->where('status', '=', 'published')->where('show_home', '=', 'on')->paginate(2); 

    loadHtml(__DIR__.'/resources/client/layout', [
        'title' => 'Inicio',
        'body' => __DIR__ . '/body/read',
        'data' => [
            'categories' => $categories,
            'posts' => $posts
        ]
    ]);
