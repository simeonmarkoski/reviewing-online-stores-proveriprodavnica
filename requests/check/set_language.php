<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: '  .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";

if (!isset($_GET['lang'])) {
    die(json_encode(["error" => "No language specified."]));
}

if (!in_array($_GET['lang'], ["en","mk"])) {
    die(json_encode(["error" => "Invalid language."]));
}

Everything::Init();
Language::LoadLanguage();
Language::SetLanguage($_GET['lang']);
die(json_encode("OK"));