<?php
require 'vendor/autoload.php';

require_once(dirname(dirname(__FILE__)) . '/config/main_config.php');

\Slim\Slim::registerAutoloader();

function autoload($className) {
    $file_path = BASE_DIR . '/api/controllers/' . $className . '.php';
    if(file_exists($file_path)){
        require_once($file_path);
    }
}
spl_autoload_register('autoload');

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

$auth_controller = new AuthController($app);

$app->post('/login', function () use ($app, $auth_controller) {
    $body = $app->request()->getBody();
    $data = json_decode($body);
    $auth_controller->login($data->email, $data->password);
});

$app->post('/logout', function () use ($app, $auth_controller) {
    //Do logout for admins here
});

$app->post('/check', function () use ($app, $auth_controller) {
    //Check current user for auth
});

$app->run();