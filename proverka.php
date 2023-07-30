<?php
include_once __DIR__ . "/objects/Everything.php";
Everything::Init();
if (!isset($_GET['url']) || $_GET['url'] === "") {
    Header("Location: /");
    die();
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
$max = round($rating * 5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$_SERVER['HTTP_HOST']?></title>
    <?php include __DIR__ . "/sources/head.php" ; ?>
</head>
<body>

<?php include __DIR__ . "/sources/header.php" ; ?>

<main id="main">
    <section id="platform" class="about">

        <div class="container" style="padding-top: 40px;" data-aos="fade-up">
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="content">
                    <?php
                    echo <<<KURAC
                    <img src="https://www.google.com/s2/favicons?sz=64&domain_url={$_GET['url']}" width="50px" height="50px" style="float: left; margin-right: 10px;">
                    KURAC;
                    ?>
                    <span style="color: grey;"><?=Language::Translate("Web page")?></span>
                    <h1 style="font-size: 30px; font-weight: bold;"><?php echo $_GET['url'] ?></h1>
                    <h4 style="font-size: 20px; margin-top: 30px;"><span style="color: grey;"><?=Language::Translate("Rating:")?> </span><b><?php echo number_format($rating * 10,2) ?>/10.00</b></h4>
                    <h4 style="font-size: 20px;"><span style="color: grey;"><?=Language::Translate("Checks:")?> </span><b><?php echo count($entries) ?></b></h4>
                </div>
                <hr>

            </div>

                <?php
                for($i = 0; $i < count($entries) && $i < 10; $i++) {
                    $entry = $entries[$i];
                    $json = json_encode($entry);
                    $time = date("M j Y G:i",strtotime($entry['Timestamp']));

                    if (str_contains($time, "Jan")) {
                        $time_mk = Language::Translate("January") . " " . str_replace("Jan ", "", $time);
                    } else if (str_contains($time, "Feb")) {
                        $time_mk = Language::Translate("February") . " " . str_replace("Feb ", "", $time);
                    } else if (str_contains($time, "Mar")) {
                        $time_mk = Language::Translate("March") . " " . str_replace("Mar ", "", $time);
                    } else if (str_contains($time, "Apr")) {
                        $time_mk = Language::Translate("April") . " " . str_replace("Apr ", "", $time);
                    } else if (str_contains($time, "May")) {
                        $time_mk = Language::Translate("May") . " " . str_replace("May ", "", $time);
                    } else if (str_contains($time, "Jun")) {
                        $time_mk = Language::Translate("June") . " " . str_replace("Jun ", "", $time);
                    } else if (str_contains($time, "Jul")) {
                        $time_mk = Language::Translate("July") . " " . str_replace("Jul ", "", $time);
                    } else if (str_contains($time, "Aug")) {
                        $time_mk = Language::Translate("August") . " " . str_replace("Aug ", "", $time);
                    } else if (str_contains($time, "Sep")) {
                        $time_mk = Language::Translate("September") . " " . str_replace("Sep ", "", $time);
                    } else if (str_contains($time, "Oct")) {
                        $time_mk = Language::Translate("October") . " " . str_replace("Oct ", "", $time);
                    } else if (str_contains($time, "Dec")) {
                        $time_mk = Language::Translate("December") . " " . str_replace("Dec ", "", $time);
                    }

                    $name = Everything::$auth->GetInfo((int)$entry["Uid"])["Name"];
                    $img = $entry['Opinion'] == 1
                        ? "https://upload.wikimedia.org/wikipedia/commons/0/03/Green_check.svg"
                        : "https://upload.wikimedia.org/wikipedia/commons/5/5f/Red_X.svg";

                    $altText = $entry['Opinion'] == 1
                        ? Language::Translate("reviewPositive")
                        : Language::Translate("reviewNegative");

                    $color = $entry['Opinion'] == 1
                        ? "#98FB98"
                        : "#FFF5EE";

                    $rest = "";
                    if ($entry['Opinion'] == 0) {
                        $rest = <<<KURAC
<hr>
<b>Коментар:</b>
<pre>
{$entry['Comment']}
</pre>
KURAC;
                        if (isset($entry["ScreenshotUrl"]) && $entry["ScreenshotUrl"] !== "" && file_exists(__DIR__ . $entry["ScreenshotUrl"])) {
                            $screenshot = file_get_contents(__DIR__ . $entry["ScreenshotUrl"]);
                            $rest .= <<<KURAC
<hr>
<img src="$screenshot" width="100%" alt="Слика од екран"/>
KURAC;

                        }
                    }
                    echo <<<KURAC
            <div class="row gx-0">
                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="500">
                    <div class="content" style="background-color: $color">
                          <img src="$img" height="12px" width="12px" alt=""/>
                          <b>
                          $time_mk
</b>
                          $rest
                          <hr>
                  <p><a href="/profile.php?uid={$entry['Uid']}">$name</a> $altText</p>
                    </div>
                </div>
            </div>
<br/>
KURAC;
                }
                ?>

        </div>
    </section>
</main>
<?php include __DIR__ . "/sources/bottom.php" ?>
</body>

</html>