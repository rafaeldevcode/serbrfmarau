<?php
    verifyMethod(500, 'POST');

    use Src\Models\Banners;

    $requests = requests();

    $banner = new Banners();

    $status = isset($requests->status) ? $requests->status : 'off';

    $banner->create([
        'title' => $requests->title,
        'subtitle' => $requests->subtitle,
        'desktop' => $requests->desktop,
        'mobile' => $requests->mobile,
        'link' => $requests->link,
        'status' => $status
    ]);

    session([
        'message' => 'Banner adicionado com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/banners', true), true, 302);
