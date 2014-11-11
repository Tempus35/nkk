<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'mode' => 'development'
));

$app->setName('NKK');

$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});

$app->config('cookies.encrypt', 'true');
$app->config('cookies.secret_key', 'nkkghostmole');
$app->config('cookies.cipher', MCRYPT_RIJNDAEL_256);
$app->config('cookies.cipher_mode', MCRYPT_MODE_CBC);
$app->config('cookies.lifetime', '30 minutes');
$app->config('cookies.path', '/');

$app->post('/login', function () use ($app) {
    //Do login for admins here
});

$app->post('/logout', function () use ($app) {
    //Do logout for admins here
});

$app->post('/check', function () use ($app) {
    //Check current user for auth
});

$app->run();