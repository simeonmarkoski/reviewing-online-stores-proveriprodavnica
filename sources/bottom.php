<footer id="footer" class="footer">



    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-info" style="margin-top: 50px">
                    <a href="index.php" class="logo d-flex align-items-center">
                        <img src="assets/img/new_logo.png" alt="">
                        <span><?=$_SERVER['HTTP_HOST']?></span>
                    </a>
                    <p>
                        <?=Language::Translate("our_platform")?>
                    </p>
                    <div class="social-links mt-3">
                        <a href="https://twitter.com/proveri_p" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="https://www.facebook.com/proveriprodavnica" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/proveri.prodavnica/" class="instagram"><i class="bi bi-instagram bx bxl-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 footer-contact">
                    <img src="assets/img/ec_trans.png" width="250px" height="80px" style="text-align: center;"/>
                    <p><?=Language::Translate("ec_trans")?></p>
                </div>

                <div class="col-lg-2 col-6 footer-links" style="margin-top: 50px;">
                    <h4><?=Language::Translate("useful_data")?></h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#services"><?=Language::Translate("services")?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/usloviZaKoristenje.php"><?=Language::Translate("terms_of_use")?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/zakonZaElektronskaTrgovija.php"><?=Language::Translate("e_comm_law")?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/sistemZaAvtomatizacija.php"><?=Language::Translate("automation_system")?></a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4><?=Language::Translate("contact")?></h4>
                    <p>
                        <?=Language::Translate("location")?> <br>
                        proveriprodavnica@hotmail.com<br>
                    </p>

                </div>



            </div>
        </div>
    </div>
</footer>

<div class="modal" id="com-error-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=Language::Translate("error")?></h5>
                <a type="button" class="close nav-link" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p id="com-error"></p>
            </div>
        </div>
    </div>
</div>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="/assets/vendor/aos/aos.js"></script>
<script src="/assets/vendor/php-email-form/validate.js"></script>
<script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/assets/vendor/purecounter/purecounter.js"></script>
<script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/assets/js/normal.js"></script>
<script src="/assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    async function loginSuccess(googleUser) {
        let idToken = googleUser.getAuthResponse()["id_token"];
        const response = await fetch('/requests/auth/google.php?idtoken='+idToken);
        const json = await response.json();
        if (json["error"] === undefined && json["success"] !== false) {
            location.reload();
        } else {
            console.error(json["error"]);
        }
    }
    async function onLoad() {
        await new Promise(resolve => {
            gapi.load('auth2', function () {
                gapi.auth2.init();
            });
            resolve();
        });

        gapi.signin2.render("google-button", {
            'scope': 'profile email',
            'width': 90,
            'height': 25,
            'longtitle': false,
            'theme': 'light',
            'onsuccess': loginSuccess,
        });
    }
</script>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>