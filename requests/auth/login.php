<?php
error_reporting(0);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: '  .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
if (Everything::$uid !== null) {
    die(json_encode(["error" => "Најавени сте."]));
}
if (!isset($_GET['email'])) {
    die(json_encode(["error" => "Не внесовте емаил."]));
}
if (!isset($_GET['password'])) {
    die(json_encode(["error" => "Не внесовте пасворд."]));
}

$uid = Everything::$auth->LoginToCookies($_GET['email'], $_GET['password']);
if ($uid === null) {
    die(json_encode(["error" => "Внесовте погрешен емаил или пасворд."]));
}
die(json_encode(["uid" => $uid]));