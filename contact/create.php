<?php

    verifyMethod(403, 'POST');

    use Src\Email\BodyEmail;
    use Src\Email\EmailServices;

    $title = 'Novo contato através do site';

    $email = new EmailServices(BodyEmail::contact(json_decode(json_encode(requests()), true), $title), $title, env('SMTP_EMAIL_FROM'));
    $email->send();

    session([
        'message' => 'Contato enviado com sucesso! Aguarde nosso retorno.',
        'type' => 'success'
    ]);

    return header(route('/', true), true, 302);
