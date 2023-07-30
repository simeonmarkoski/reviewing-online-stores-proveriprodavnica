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

            <h1><?=Language::Translate("Law on Electronic Commerce")?></h1>

            <br />

            <p>
                <?=Language::Translate("According to the law on electronic commerce, the electronic trader is obliged to clearly display at least the following information:")?>
            </p>

            <ul>
                <li><?=Language::Translate("According to the law on electronic commerce, the electronic trader is obliged to clearly display at least the following information:")?></li>
                <li><?=Language::Translate("Information about the service provider on the basis of which the recipient of the service can contact him in a direct and efficient way, including the e-mail address")?></li>
                <li><?=Language::Translate("Decision by which the information society service provider is registered in the Central Register of the Republic of Macedonia")?></li>
                <li><?=Language::Translate("Data from the competent authority, if the service provider is subject to an obligation to issue licenses or other type of approvals")?></li>
                <li><?=Language::Translate("Tax number if the service provider is a VAT payer.")?></li>
            </ul>

        </div>
    </div>
</div>
<?php include __DIR__ . "/sources/bottom.php" ?>
</body>
</html>
