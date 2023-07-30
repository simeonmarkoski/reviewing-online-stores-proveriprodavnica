function com(form, action) {
    if (window["com_" + action] !== undefined) {
        if (!(form instanceof HTMLFormElement)) {
            console.error("Wtf?");
            return;
        }
        const values = {};
        for(const element of form.elements) {
            if (!(element instanceof HTMLInputElement)) {
                continue;
            }
            values[element.name] = element.value;
        }
        window["com_" + action](values);
    }
}

function com_error(message) {
    $('#com-error-modal').modal();
    $('#com-error').text(message);
    console.error(message);
}

function com_login(values) {
    const email = values["email"];
    const password = values["password"];
    fetch('/requests/auth/login.php?email=' + encodeURIComponent(email) + "&password=" + encodeURIComponent(password))
        .then(response => response.json())
        .then(data => {
            if (data.error !== undefined) {
                com_error(data.error);
            } else {
                location.reload();
            }
        });
}

function check() {
    let url = encodeURIComponent($('#check').val());
    if (!url.includes("https://") && !url.includes("http://")) {
        if (url.includes("www.")) {
            url = url.replaceAll("www.", "https://").replaceAll("www.", "http://");
        } else {
            url = "https://" + url;
        }
    }
    if (url[url.length-1] != "/") {
        url += "/";
    }
    document.location = "/proverka.php?url=" + url;
}

function com_logout(values) {
    (async() => {
        try {
            const auth2 = gapi.auth2.getAuthInstance();
            await auth2.signOut();
            auth2.disconnect();
        } catch {
            // ignored
        }
        fetch('/requests/auth/logout.php')
            .then(response => response.json())
            .then(data => {
                if (data.error !== undefined) {
                    com_error(data.error);
                } else {
                    location.reload();
                }
            });
    })();


}

function com_register(values) {
    const confirm_password = values["confirm-password"];
    const password = values["password"];
    if (confirm_password !== password) {
        com_error("Потврдниот пасворд не е точен.");
        return;
    }
    const name = values["name"];
    const email = values["email"];
    fetch('/requests/auth/register.php?email=' + encodeURIComponent(email) + "&password=" + encodeURIComponent(password)  + "&name=" + encodeURIComponent(name))
        .then(response => response.json())
        .then(data => {
            if (data.error !== undefined) {
                com_error(data.error);
            } else {
                location.reload();
            }
        });
}