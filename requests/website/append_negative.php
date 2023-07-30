<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: ' .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
if (!isset($_GET['url'])) {
    die(json_encode(["error" => "Невалидно барање. (url)"]));
}
if (!isset($_GET['comment'])) {
    die(json_encode(["error" => "Невалидно барање. (comment)"]));
}
if (!isset($_GET['ssl'])) {
    die(json_encode(["error" => "Невалидно барање. (ssl)"]));
}
if (!isset($_GET['company'])) {
    die(json_encode(["error" => "Невалидно барање. (company)"]));
}
if (!isset($_GET['contact'])) {
    die(json_encode(["error" => "Невалидно барање. (contact)"]));
}
if (!isset($_GET['screenshot_url'])) {
    die(json_encode(["error" => "Невалидно барање. (screenshot_url)"]));
}
if (Everything::$uid === null) {
    die(json_encode(["error" => "Невалидно барање. (автентикација)"]));
}
$result = Everything::$checked_web->AppendNegative
(
    Everything::$uid,
    $_GET['url'], $_GET['comment'],
    $_GET['screenshot_url'],
    $_GET['ssl'] === "true",
    $_GET['company'] === "true",
    $_GET['contact'] === "true"
);
die(json_encode(["success" => $result]));