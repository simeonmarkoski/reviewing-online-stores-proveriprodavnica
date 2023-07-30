<?php
include_once __DIR__ . "/objects/Everything.php";
Everything::Init();
function generateBox(bool $is_fb_page, string $name, float $value, int $count) {
    $stars = round($value * 5);
    $grade = number_format($value * 10,2);
    $type = !$is_fb_page ? Language::Translate("Web page") : Language::Translate("Facebook store");
        echo <<<KURAC
<div class="col-sm">
<img src="https://www.google.com/s2/favicons?sz=64&domain_url=$name" width="40px" height="40px" style="float: left; margin-right: 10px;">
<p style="color: grey; margin-bottom: 0; font-size: 15px;">$type</p>
<h3 style="font-size: 20px; font-weight: bold;"><a href="/proverka.php?url=$name" style="color: black;">$name</a></h3>
KURAC;
        for($i = 0; $i < $stars; $i++) {
            echo '<span class="fa fa-star checked"></span>';
        }
        for($i = 0; $i < 5 - $stars; $i++) {
            echo '<span class="fa fa-star"></span>';
        }
        $rating = Language::Translate("rating");
        $Checks = Language::Translate("Checks");
        echo <<<KURAC
<h4 style="font-size: 17px;"><span style="color: grey"> $rating: </span><b>$grade</b></h4>
<h4 style="font-size: 17px;"><span style="color: grey"> $Checks: </span><b>$count</b></h4>
        </div>
KURAC;
}

function calculateRatings() : array {
    $entries = array_merge(Everything::$checked_web->GetAll(), Everything::$checked_fb->GetAll());
    $opinions = [];
    $counts = [];
    $types = [];
    $processed = [];
    foreach($entries as $entry) {
        if (!isset($opinions[$entry["Url"]])) {
            $opinions[$entry["Url"]] = 0.0;
            $counts[$entry["Url"]] = 0;
            $types[$entry["Url"]] = $entry["Type"];
        }
        $opinions[$entry["Url"]] += (float)$entry["Opinion"];
        $counts[$entry["Url"]]++;
    }
    foreach($opinions as $site => $rating) {
        $processed[] = ["site" => $site,"rating" => $rating / $counts[$site], "type" => $types[$site], "count" => $counts[$site]];
    }
    usort($processed, fn($a, $b) => $a["count"] > $b["count"] ? -1 : 1);
    return $processed;
}
$ratings = calculateRatings();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?=$_SERVER['HTTP_HOST']?></title>
    <?php include __DIR__ . "/sources/head.php" ; ?>
</head>

<body>

<?php include __DIR__ . "/sources/header.php" ; ?>

  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up"><?=Language::Translate("List of all analyzed and rated e-shops!")?></h1>
          <h2 data-aos="fade-up" data-aos-delay="400"></h2>
          
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/ss.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section>



  <div class="container">

    <div style="text-align: center; padding: 50px;">
      <h2 style="color: #012970"><b><?=Language::Translate("List of verified e-shops")?></b></h2>
    </div>


      <?php
      echo '<div class="row" style="margin-bottom: 35px;">';
      $i = 0;
      foreach($ratings as $rating) {
          // if ($i > 30) break;
          if ($i++ % 3 === 0) {
              echo '</div><div class="row" style="margin-bottom: 35px;">';
          }
          generateBox($rating["type"] !== "Website", (string)$rating["site"], (float)$rating["rating"], (int)$rating["count"]);
      }
      if ($i % 3 === 2) {
          echo "<div class='col-sm'></div>";
      }
      echo '</div>';
      ?>
  </div>

<?php include __DIR__ . "/sources/bottom.php" ?>
</body>

</html>