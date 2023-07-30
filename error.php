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
        <div class="main-body" style="padding: 40px 0">

            <h1><?=Language::Translate("not_rated")?></h1>

            <br />
        </div>
    </div>
</div>
<?php include __DIR__ . "/sources/bottom.php" ?>
</body>
</html>
