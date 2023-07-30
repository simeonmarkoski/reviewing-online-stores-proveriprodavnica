<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: '  .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
if (!isset($_GET['url']) || $_GET['url'] === "") {
    die(json_encode([]));
}


$url = $_GET['url'];
if (substr($url, strlen($url)-1) !== '/') {
    $url .= '/';
}
if (!strpos($url, "//")) {
    $url = "//".$url;
}
$entries = array_merge(Everything::$checked_web->GetAllByUrl($url), Everything::$checked_fb->GetAllByUrl($url));
foreach($entries as $k => $entry) {
    $entries[$k]["User"] = Everything::$auth->GetInfo($entry["Uid"]);
}
die(json_encode($entries));
