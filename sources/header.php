<header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/index.php" class="logo d-flex align-items-center">
            <img src="/assets/img/new_logo.png" alt="">
            <span><?=$_SERVER['HTTP_HOST']?></span>
        </a>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="/index.php#hero"><?=Language::Translate('check')?></a></li>
                <li><a class="nav-link scrollto" href="/index.php#platform"><?=Language::Translate('for_platform')?></a></li>
                <li><a class="nav-link scrollto" href="/index.php#services"><?=Language::Translate('services')?></a></li>

                <li><a class="nav-link scrollto" href="/listaProdavnici.php" style="padding-left: 100px;"><?=Language::Translate('rating')?></a></li>

                <?php
                include_once __DIR__ . "/../objects/Everything.php";
                Everything::Init();
                $login = Language::Translate('login');
                $register = Language::Translate('register');
                $profile = Language::Translate('profile');
                $logout = Language::Translate('logout');
                if (Everything::$uid === null) {
                    echo <<<KURAC
                <li><a class="getstarted scrollto" href="/login.php">$login</a></li>
KURAC;
                } else {
                    echo <<<KURAC
                <li><a class="nav-link scrollto" href="/profile.php">$profile</a></li>
                <li><a class="getstarted scrollto" href="javascript:void(0)" onclick="com_logout()">$logout</a></li>

KURAC;
                }
                ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span><?=Language::Translate('Language')?></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown09">
                        <a style="padding: .25rem 1rem" class="dropdown-item" href="#mk" onclick="fetch('/requests/check/set_language.php?lang=mk').then(() => location.reload())"><img src="assets/img/mk.png" width="20px" height="10px"><?=Language::Translate('Macedonian')?></a>
                        <a style="padding: .25rem 1rem" class="dropdown-item" href="#en" onclick="fetch('/requests/check/set_language.php?lang=en').then(() => location.reload())"><img src="assets/img/en.svg" width="20px" height="20px"><?=Language::Translate('English')?></a>
                    </div>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>
