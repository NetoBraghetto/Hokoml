<?php
if (empty($_GET['code'])) {
    echo 'Ops, param code not found';
    exit;
}

require __DIR__ . '/../../vendor/autoload.php';
$config = require __DIR__ . '/config.php';
$sessionPath = __DIR__ . '/fake_session';

use Braghetto\Hokoml\Hokoml;

$hokoml = new Hokoml($config);
$app = $hokoml->app();
$response = $app->authorize($_GET['code']);
if ($response['http_code'] === 200) {
    $session = json_decode(file_get_contents($sessionPath), true);
    $session['mercado_livre'] = [
        'access_token' => $response['body']['access_token'],
        'refresh_token' => $response['body']['refresh_token'],
        'expires_in' => time() + $response['body']['expires_in'] + 1,
        'user_id' => $response['body']['user_id'],
    ];
    file_put_contents($sessionPath, json_encode($session));
}
var_dump($response);
