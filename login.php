<?php
include_once __DIR__ . "/objects/Everything.php";
Everything::Init();
if (Everything::$uid !== null) {
    Header("Location: /profile.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$_SERVER['HTTP_HOST']?></title>
    <?php include __DIR__ . "/sources/head.php" ; ?>
</head>
<body>
<?php include __DIR__ . "/sources/header.php" ; ?>
<section id="najava" class="najava">
    <div class="container" data-aos="fade-up" style="margin-top: 50px !important;">
        <header class="section-header">
            <h2><?=Language::Translate("LOGIN")?></h2>
            <p><?=Language::Translate("Log in")?></p>
        </header>
        <div class="col-md-9" style="self-align: center;margin-left: 32%;">
            <div class="col-lg-6">
                <div class="row gy-4">
                    <div class="col-md-12 text-center">
                        <div id="google-button"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . "/sources/bottom.php" ?>
</body>
</html>