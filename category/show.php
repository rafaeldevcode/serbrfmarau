<?php

    use Src\Models\Category;
    use Src\Models\Location;

    verifyMethod(405, 'GET');

    $category = new Category();
    $location = new Location();
    $category = $category->find(slug(2));

    if(is_null($category->data)) abort(404, 'Category not found!', 'error');

    $locations = $category->locations();

    loadHtml(__DIR__.'/../resources/client/layout', [
        'title' => "Categoria - {$category->data->name}",
        'body' => __DIR__ . '/body/read',
        'data' => [
            'category' => $category->data,
            'locations' => $locations
        ]
    ]);
