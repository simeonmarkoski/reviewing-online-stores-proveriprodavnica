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
if (!isset($_GET['screenshot_url'])) {
    die(json_encode(["error" => "Невалидно барање. (screenshot_url)"]));
}
if (!isset($_GET['comment'])) {
    die(json_encode(["error" => "Невалидно барање. (comment)"]));
}
if (!isset($_GET['created_at'])) {
    die(json_encode(["error" => "Невалидно барање. (created_at)"]));
}
if (!isset($_GET['followers'])) {
    die(json_encode(["error" => "Невалидно барање. (followers)"]));
}
if (!isset($_GET['changed_name'])) {
    die(json_encode(["error" => "Невалидно барање. (changed_name)"]));
}

if (Everything::$uid === null) {
    die(json_encode(["error" => "Невалидно барање. (автентикација)"]));
}
$result = Everything::$checked_fb->AppendNegative
(
    Everything::$uid,
    $_GET['url'],
    $_GET['comment'],
    $_GET['screenshot_url'],
    (int)$_GET['created_at'],
    (int)$_GET['followers'],
    $_GET['changed_name'] === "true"

);
die(json_encode(["success" => $result]));