<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: '  .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
if (!isset($_GET['url']) || $_GET['url'] === "") {
    die(json_encode(["rating"=>0,"count"=>0]));
}


$url = $_GET['url'];
if (substr($url, strlen($url)-1) !== '/') {
    $url .= '/';
}
if (!strpos($url, "//")) {
    $url = "//".$url;
}
$entries = array_merge(Everything::$checked_web->GetAllByUrl($url), Everything::$checked_fb->GetAllByUrl($url));
$rating = 0.0;
foreach($entries as $entry) {
    $rating += (float)$entry["Opinion"];
}
if (count($entries) !== 0) {
    $rating /= count($entries);
} else {
    $rating = 0;
}
die(json_encode(["rating"=>$rating,"count"=>count($entries)]));
