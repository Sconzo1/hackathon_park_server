<?php

return [
    'db' => [
        'host' => '127.0.0.1',
        'user' => 'mysql',
        'name' => 'hackathon_db',
        'pass' => 'mysql',
    ],
    'media' => [
        'dirImg_products' => 'images/',
        'extImg_products' => '.png'
    ],
    'api' => [
        'v' => '2.0',
        'url' => (!empty($_SERVER['HTTPS']) ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST']."/"
    ]
];