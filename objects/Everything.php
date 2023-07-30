<?php
include_once __DIR__ . "/Language.php";
include_once __DIR__ . "/Database.php";
include_once __DIR__ . "/Users.php";
include_once __DIR__ . "/CheckedWebsites.php";
include_once __DIR__ . "/CheckedFacebookPage.php";
const GOOGLE_CLIENT_ID = "739008210467-cmd9vfkob41tvp15gngt6nh6s0ueqd0t.apps.googleusercontent.com";
if (!function_exists('str_contains')) {
    function str_contains(string $str, string $val): bool
    {
        return strpos($str, $val) !== false;
    }
}
class Everything {
    public static Users $auth;
    public static CheckedWebsites $checked_web;
    public static CheckedFacebookPage $checked_fb;
    public static ?int $uid;
    public static $stdout;
    public static function Log(string $message) {
        fwrite(self::$stdout, $message . "\n");
    }
    public static function Init() {
        date_default_timezone_set("Europe/Skopje");
        self::$stdout = fopen("php://stdout", "w");
        self::$auth = new Users();
        self::$uid = self::$auth->LoginFromCookies();
        self::$checked_fb = new CheckedFacebookPage();
        self::$checked_web = new CheckedWebsites();
    }

    public static function VerifyIdToken(string $idToken): ?array {
        require_once __DIR__ .'/../vendor/autoload.php';
        $client = new Google_Client(['client_id' => GOOGLE_CLIENT_ID]);
        $payload = $client->verifyIdToken($idToken);
        return $payload ? $payload: null;
    }

    public static function ProblematicSites() : int
    {
        return self::$checked_web->CountProblematic() + self::$checked_fb->CountProblematic();
    }

    public static function CheckedWebsites() : int
    {
        return self::$checked_web->Count() + self::$checked_fb->Count();
    }

    public static function UserCount() : int
    {
        return self::$auth->Count();
    }
}