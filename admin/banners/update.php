<?php
    verifyMethod(500, 'POST');

    use Src\Models\Banners;

    $requests = requests();

    $banner = new Banners();
    $banner = $banner->find($requests->id);

    $status = isset($requests->status) ? $requests->status : 'off';

    $banner->update([
        'title' => $requests->title,
        'subtitle' => $requests->subtitle,
        'desktop' => $requests->desktop,
        'mobile' => $requests->mobile,
        'status' => $status
    ]);

    session([
        'message' => 'Banner atualizada com sucesso!',
        'type' => 'success'
    ]);

    return header(route('/admin/categories', true), true, 302);
