<?php

    use Src\Models\Category;

    verifyMethod(405, 'GET');

    $category = new Category();
    $categories = $category->get();

    loadHtml(__DIR__.'/../resources/client/layout', [
        'title' => 'Agendamentos',
        'body' => __DIR__ . '/body/read',
        'data' => [
            'categories' => $categories
        ]
    ]);
