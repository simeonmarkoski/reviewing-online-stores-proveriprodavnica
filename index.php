<?php
if (php_sapi_name() == 'cli-server') {
    $url = $_SERVER['REQUEST_URI'];
    if (!($url === "/" || $url === "/index.php")) {
        return false;
    }
}
if (!file_exists(__DIR__ . "/uploaded/")) {
    mkdir(__DIR__ . "/uploaded/");
}
?>
<?php include __DIR__ . "/objects/Everything.php" ; ?>
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
        <!--<div id="proveri_prodavnica_extension_status" style="display:none;" loaded="false"><h1>Please install the extension.</h1></div> -->

        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up"><?=Language::Translate("together_against")?></h1>
                <h2 data-aos="fade-up" data-aos-delay="200"><?=Language::Translate("Enter the page from which you plan to order to check if that page is registered as an e-merchant.")?></h2>
                <div data-aos="fade-up" data-aos-delay="400">
                    <input type="text" class="form-control" id="check" aria-describedby="check-help" placeholder="www.primerprodavnica.mk" style="margin-top: 30px">
                    <small id="check-help" class="form-text text-muted" style="margin-left: 5px"><?=Language::Translate("Enter a link from the store link")?></small>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center text-lg-start">
                        <a href="javascript:void(0)" onclick="check()" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <span><?=Language::Translate("Check")?></span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="text-center text-lg-start">
                        <a href="https://chrome.google.com/webstore/detail/%D0%BF%D1%80%D0%BE%D0%B2%D0%B5%D1%80%D0%B8-%D0%BF%D1%80%D0%BE%D0%B4%D0%B0%D0%B2%D0%BD%D0%B8%D1%86%D0%B0/gbokbnfblfkdbaapbfjljhagnccnfhjd" target="_blank" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                            <i class="bi bi-download"></i>
                            <span style="padding-left: 10px;"><?=Language::Translate("Install for Free")?></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="100">
                <img src="assets/img/extensionHead.png" class="img-fluid" alt="">
            </div>
        </div>
    </div>

</section>


<section id="counts" class="counts">
    <div class="container" data-aos="fade-up">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="<?php
                        echo Everything::UserCount()
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p><?=Language::Translate("Happy customers")?></p>
                    </div>
                </div>
            </div>


            <?php
            $checked = Everything::CheckedWebsites();
            $problem = Everything::ProblematicSites();
            ?>

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="<?php
                        echo $checked
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p><?=Language::Translate("Checked websites")?></p>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #bb0852;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="<?php
                        echo $problem
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p><?=Language::Translate("Reported problems")?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="count-box">
                    <i class="bi bi-people" style="color: #bb0852;"></i>
                    <div>
                        <span data-purecounter-start="0" data-purecounter-end="<?php
                        echo $checked-$problem
                        ?>" data-purecounter-duration="1" class="purecounter"></span>
                        <p><?=Language::Translate("Reported praise")?></p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>


<main id="main">
    <section id="platform" class="about">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="content">
                        <h3><?=Language::Translate("About the platform")?></h3>
                        <h2><?=Language::Translate("Reliability is the best feature of any e-shop.")?></h2>
                        <p>
                            <?=Language::Translate("Be assured of the security of your purchasing process with the help of our notification system. Our platform will provide greater security and guarantee that everyone will get what they want, and by registering unregistered traders will help for the good of all.")?>
                        </p>
                        <div class="text-center text-lg-start">
                            <a href="https://ecommerce4all.mk/moduli/siva-ekonomija/opis-modul-4/?fbclid=IwAR33OhpPgk62euKdZcBWjG56LN96XWQaTOS1NOMKw43sUndhdSF6cLEjeH4" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center" target="_blank">
                                <span><?=Language::Translate("More on the shadow economy")?></span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">

                    <img src="assets/img/vtora_slika.png" class="img-fluid" alt="" style="padding-left: 5px">
                </div>

            </div>
        </div>

    </section>

    <section id="services" class="values">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2><?=Language::Translate("Our values")?></h2>
                <p><?=Language::Translate("Services")?></p>
            </header>

            <div class="row">

                <div class="col-12">
                    <div class="box" data-aos="fade-up" data-aos-delay="200">
                        <img src="assets/img/features-2.png" style="width: auto; height: auto;" class="img-fluid" alt="">
                        <h3><?=Language::Translate("Extension")?></h3>
                        <p><?=Language::Translate("The first extension that allows reporting the validity of a website or social media page.")?></p>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <section id="features" class="features">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2><?=Language::Translate("Explanations")?></h2>
                <p><?=Language::Translate("What does our extension do")?></p>
            </header>

            <div class="row">

                <div class="col-lg-6">
                    <img src="assets/img/vtora_slika.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                    <div class="row align-self-center gy-4">

                        <div class="row-md-6" data-aos="zoom-out" data-aos-delay="150">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3><?=Language::Translate("Detects suspicious traders")?></h3>
                            </div>
                        </div>
                        <div class="row-md-6" data-aos="zoom-out" data-aos-delay="150">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3><?=Language::Translate("Warns the consumer before any visit to a suspicious online store")?></h3>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

            <div class="row feture-tabs" data-aos="fade-up">
                <div class="col-lg-6">


                    <ul class="nav nav-pills mb-1">
                        <li>
                            <a class="nav-link" data-toggle="pill" href="#tab3"><?=Language::Translate("Extension")?></a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="tab3">
                            <p><?=Language::Translate("The extension visually displays the validity of the e-store itself through its automatic verification.")?></p>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-check2"></i>
                                <h4><?=Language::Translate("Supported by the most popular ISPs")?></h4>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-check2"></i>
                                <h4><?=Language::Translate("Without using private data")?></h4>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-check2"></i>
                                <h4><?=Language::Translate("Website check")?></h4>
                            </div>
                        </div><!-- End Tab 3 Content -->
                    </div>

                </div>

                <div class="col-lg-6">
                    <img src="assets/img/features-2.png" class="img-fluid" alt="">
                </div>

            </div>

        </div>

    </section>

    

</main>
<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            const element = document.getElementById('proveri_prodavnica_extension_status');
            const extensionDetected = element.getAttribute('loaded') === 'true';
            if (!extensionDetected) {
                element.style.display = "block";
            }
        }, 100);
    });
</script>
<?php include __DIR__ . "/sources/bottom.php" ?>
</body>

</html>
