<?php
error_reporting(0);

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: ' .$_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

include_once __DIR__ . "/../../objects/Everything.php";
Everything::Init();
die(json_encode(["uid" => Everything::$uid, "data" => Everything::$uid === null ? null : Everything::$auth->GetInfo(Everything::$uid)]));