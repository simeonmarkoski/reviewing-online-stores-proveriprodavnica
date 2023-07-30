<?php
include_once __DIR__ . "/objects/Everything.php";
Everything::Init();
if (Everything::$uid === null) {
    Header("Location: /login.php");
    die();
}
$uid = !isset($_GET['uid']) ? Everything::$uid : (int)$_GET['uid'];
$profile_data = Everything::$auth->GetInfo($uid);
$fb_array = Everything::$checked_fb->GetAllByUid($uid);
$web_array = Everything::$checked_web->GetAllByUid($uid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$_SERVER['HTTP_HOST']?></title>
    <?php include __DIR__ . "/sources/head.php" ; ?>
</head>
<body>

<?php include __DIR__ . "/sources/header.php" ; ?>
<div class="container" style="margin-top: 100px">
    <div class="container">
        <div class="main-body">

            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index.php"><?=Language::Translate("At home")?></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)"><?=Language::Translate("Buyer")?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=Language::Translate("Profile")?></li>
                </ol>
            </nav>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><?=Language::Translate("Username")?></h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $profile_data['Name'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0"><?=Language::Translate("Email")?></h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $profile_data['Email'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gutters-sm">
                    <div class="col-sm-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i><?=Language::Translate("Detected sites") ?></h6>
                                <?php
                                if (count($web_array) + count($fb_array) === 0) {
                                    $no_detected_sites = Language::Translate("No detected sites");
                                    echo <<< KURAC
                                <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"></i>$no_detected_sites</h6>
KURAC;

                                }
                                foreach(array_merge($web_array, $fb_array) as $item) {
                                    $time = date("M j Y G:i",strtotime($item['Timestamp']));
                                    $img = $item['Opinion'] == 1
                                        ? "https://upload.wikimedia.org/wikipedia/commons/0/03/Green_check.svg"
                                        : "https://upload.wikimedia.org/wikipedia/commons/5/5f/Red_X.svg";

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


                                    echo <<<KURAC
<img src="https://www.google.com/s2/favicons?sz=64&domain_url={$item['Url']}" width="30px" height="30px" style="float: left; margin-right: 10px;">
<span style="font-size: 15px; color: grey;">Веб страна</span><br />
                          <b><a href="/proverka.php?url={$item['Url']}" style="color: black;"; font-size: 25px;> {$item['Url']}</></b>
                          <div>
                          <img src="$img" height="12px" width="12px" alt=""/>     
                          <span style="font-size: 15px;">$time_mk</span>
                          </div>
</a>
<br />
KURAC;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/sources/bottom.php" ?>
</body>

</html>
