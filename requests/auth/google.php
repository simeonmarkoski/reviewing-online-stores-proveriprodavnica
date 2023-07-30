<?php
error_reporting(0);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: '  .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();

if (!isset($_GET['idtoken'])) {
    die(json_encode(["error" => "Невалидно барање."]));
}

$payload = Everything::VerifyIdToken($_GET['idtoken']);

if ($payload === null) {
    die(json_encode(["error" => "Невалидна најава."]));
}

$userid = $payload["sub"];
$email = $payload["email"];
$name = $payload["name"];

if (Everything::$uid === null) {
    if (Everything::$auth->LoginFromGoogleAccount($userid) !== null) {
        die(json_encode(["success" => true]));
    }
    $register_result = Everything::$auth->Register($name, $email, $userid);
    if ($register_result === null) {
        die(json_encode(["error" => "Неуспешна регистрација."]));
    }
    Everything::$uid = $register_result;
}

if (!Everything::$auth->AttachGoogleAccount(Everything::$uid, $userid)) {
    die(json_encode(["error" => "Не може да се додаде Google сметка сега."]));
}
die(json_encode(["success" => true]));