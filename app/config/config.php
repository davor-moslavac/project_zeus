<?php

use Phalcon\Config;
use Phalcon\Logger;

/**
 * Define constants
 */
$baseDir = realpath(__DIR__ . '/../..');
$appDir = $baseDir . '/app';

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'vokuro'
    ],
    'application' => [
        'controllersDir' => $appDir . '/controllers/',
        'modelsDir'      => $appDir . '/models/',
        'formsDir'       => $appDir . '/forms/',
        'viewsDir'       => $appDir . '/views/',
        'libraryDir'     => $appDir . '/library/',
        'pluginsDir'     => $appDir . '/plugins/',
        'cacheDir'       => $appDir . '/cache/',
        'baseUri'        => '/',
        'publicUrl'      => 'MediaRatings.phalconphp.com',
        'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'mail' => [
        'fromName' => '',
        'fromEmail' => '',
        'smtp' => [
            'server' => 'smtp.gmail.com',
            'port' => 587,
            'security' => 'tls',
            'username' => '',
            'password' => ''
        ]
    ],
    'amazon' => [
        'AWSAccessKeyId' => '',
        'AWSSecretKey' => ''
    ],
    'logger' => [
        'path'     => $baseDir . '/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
    // Set to false to disable sending emails (for use in test environment)
    'useMail' => false,
    'movieDatabase' =>
    [
        'apiKey' => 'd939353f7e926e52ce71066b87971f5d',
        'apiBaseUrl' => 'https://api.themoviedb.org/3/',
        'image_url' => 'http://image.tmdb.org/t/p/original' //copied from configurattion response
    ]
]);
