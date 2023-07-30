<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: ' .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

if (!isset($_POST)) {
    die(json_encode(["error" => "Нема податоци."]));
}

$input = fopen("php://input", "r");
$id = "/uploaded/" . sha1(microtime() . time() . $_SERVER['HTTP_ORIGIN']) . "." . time() .  ".url";
$file = __DIR__ . "/../../" . $id;
$fs = fopen($file, "wb");
$size = stream_copy_to_stream($input, $fs);
die(json_encode(["url" => $id, "size" => $size]));