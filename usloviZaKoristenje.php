<?php
    include_once __DIR__ . "/objects/Everything.php";
    Everything::Init();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$_SERVER['HTTP_HOST']?></title>
    <?php include __DIR__ . "/sources/head.php" ; ?>
</head>
<body>

<?php include __DIR__ . "/sources/header.php" ; ?>
<div class="container" style="margin-top: 150px">
    <div class="container">
        <div class="main-body">

            <h1><?=Language::Translate("Terms of use")?></h1>

            <p><?=Language::Translate("Dear users,")?></p>

            <p><?=Language::Translate("usl1")?></p>

            <ul>
                <li><b><?=Language::Translate("General terms")?></b></li>
                <p><?=Language::Translate("nar1")?></p>
                <p><?=Language::Translate("nar3")?></p>
                <li><b><?=Language::Translate("Links to other websites")?></b></li>
                <p><?=Language::Translate("nar3")?></p>
                <li><?=Language::Translate("Site access")?></li>
                <p><?=Language::Translate("nar5")?></p>
                <p><?=Language::Translate("nar5")?></p>
            </ul>

        </div>
    </div>
</div>
<?php include __DIR__ . "/sources/bottom.php" ?>
</body>
</html>
