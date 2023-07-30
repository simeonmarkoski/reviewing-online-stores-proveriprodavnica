<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: '  .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
if (!isset($_GET['url'])) {
    die(json_encode(["error" => "Невалидно барање. (url)"]));
}
if (!isset($_GET['comment'])) {
    die(json_encode(["error" => "Невалидно барање. (comment)"]));
}
if (Everything::$uid === null) {
    die(json_encode(["error" => "Невалидно барање. (автентикација)"]));
}
$result = Everything::$checked_fb->AppendPositive(Everything::$uid, $_GET['url'], $_GET['comment']);
die(json_encode(["success" => $result]));