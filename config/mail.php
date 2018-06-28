<?php

    $date = explode("/", getenv("SMTP_DATE"));

    if(!empty($date)){
        $local = "smtp.mailtrap.io/465/from@example.com/Laravel Mail/TLS/36d7bf175fbac2/b2939f2fb595eb";
        $date = explode("/", $local);
    }

    $host = $date['0'];
    $port = $date['1'];
    $address = $date['2'];
    $name = $date['3'];
    $encryption = $date['4'];
    $username = $date['5'];
    $password = $date['6'];

return [

    'driver' => 'smtp',
    'host' => $host,
    'port' => $port,
    'from' => [
        'address' => $address,
        'name' => $name,
    ],
    'encryption' => $encryption,
    'username' => $username,
    'password' => $password,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => [
        'theme' => 'default',
        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
];
