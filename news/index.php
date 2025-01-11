<?php

    use Src\Models\Posts;

    $posts = new Posts();
    $requests = requests();

    $posts = !isset($requests->search) 
        ? $posts->where('status', '=', 'published')->paginate(10) 
        : $posts->where('status', '=', 'published')->where('title', 'LIKE', "%{$requests->search}%")->paginate(10);

    $image = (!is_null(SETTINGS) && !empty(SETTINGS['site_logo_main']) )
        ? asset('assets/images/'.SETTINGS['site_logo_main'], true) 
        : asset('assets/images/logo_main.png', true);

    loadHtml(__DIR__.'/../resources/client/layout', [
        'title' => 'Blog',
        'description' => !is_null(SETTINGS) ? SETTINGS['site_description'] : '',
        'image' => $image,
        'body' => __DIR__."/body/read",
        'data' => ['posts' => $posts],
    ]);
