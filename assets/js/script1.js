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
        if (val.match(/\d{1,}/) && val.match(/[a-zA-ZäöüÄÖÜ]{1,}/) && val.match(/\W/)) {
            call.style.color = "#428c0d";
            call.innerHTML = "<p>Very strong</p>";
        }


        // If the password contains only a number or a special character, is it "strong"?
        else if (val.match(/\d{1,}/) && val.match(/[a-zA-ZäöüÄÖÜ]{1,}/) || val.match(/\W/) && val.match(/[a-zA-ZäöüÄÖÜ]{1,}/)) {
            call.style.color = "#56a40c";
            call.innerHTML = "<p>Your password is strong</p>";

        } else
        // Here the password contains neither digits nor special characters and therefore .. "Please make your password stronger".
        {

            call.style.color = "#ff9410";
            call.innerHTML = "<p class='error-text error-text-pass'>Please make your password stronger</p>";
        }
    } else {
        call.style.color = "#ff352c";
        call.innerHTML = "<p class='error-text error-text-pass'>At least 8 characters, a number of symbol</p>";
    }
}