<?php
include_once __DIR__ . "/objects/Everything.php";
Everything::Init();
if (Everything::$uid === null) {
    include_once __DIR__ . "/sources/google.php";
    die();
}
?>
<noscript>
    <h1><?=Language::Translate("enable_javascript")?></h1>
</noscript>
<h2><?=Language::Translate("login_success")?></h2>
<p><?=Language::Translate("you_can_close")?></p>
<script>
    close();
</script>