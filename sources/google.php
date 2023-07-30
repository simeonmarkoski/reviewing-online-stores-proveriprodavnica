<meta name="google-signin-client_id"
      content="739008210467-cmd9vfkob41tvp15gngt6nh6s0ueqd0t.apps.googleusercontent.com">
<div id="google-button"></div>
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
<noscript>
    <h1><?=Language::Translate("enable_javascript")?></h1>
</noscript>