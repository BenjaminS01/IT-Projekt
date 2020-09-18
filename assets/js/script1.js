function validatePassword() {

    if (document.getElementById('registerPassword')) {
        var val = document.getElementById('registerPassword').value;
        var call = document.getElementById('feedback');
    }
    if (document.getElementById('newPassword')) {
        var val = document.getElementById('newPassword').value;
        var call = document.getElementById('feedback2');
    }

    if (val.length > 7) {

        // If the password has at least one number in addition to letters
        // and contains a special character, it is "very strong".
        if (val.match(/[a-zA-Z]{1,}/) && val.match(/[0-9]{1,}/) && val.match(/\W/)) {
            call.style.color = "#428c0d";
            call.innerHTML = "<p>Ihr Passwort ist sehr sicher</p>";
        }


        // If the password contains only a number or a special character
        else if (val.match(/[a-zA-Z]{1,}/) && val.match(/[0-9]{1,}/)) {
            call.style.color = "#56a40c";
            call.innerHTML = "<p>Ihr Passwort ist sicher</p>";

        } else
        // Here the password contains neither digits nor special characters and therefore 
        {

            call.style.color = "#ff352c";
            call.innerHTML = "<p class='error-text error-text-pass'>Bitte verwenden Sie mindestens eine Ziffer und einen Buchstabe</p>";
        }
    } else {
        call.style.color = "#ff352c";
        call.innerHTML = "<p class='error-text error-text-pass'>Bitte verwenden Sie 8 Zeichen mit mindestens einer Ziffer und einem Buchstabe</p>";
    }
}