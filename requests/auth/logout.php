<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
if (Everything::$uid !== null) {
    Everything::$auth->Logout();
    die(json_encode("ОК"));
}
die(json_encode(["error" => "Не сте најавени."]));
