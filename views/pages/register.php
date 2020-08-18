<div class="register">
  <div class="mx-auto">
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=register'; ?>" class="needs-validation" novalidate>
      <div class="form-group">
        <label for="email">Vorname:</label>
        <input type="text" class="form-control" id="registerFirstName" placeholder="Vorname" name="firstName" required 
        value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group">
        <label for="pwd">Nachname:</label>
        <input type="text" class="form-control" id="registerLastname" placeholder="Nachname" name="lastName" required >
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>

      <label for="tel">Geschlecht:</label>
      <br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
        <label class="form-check-label" for="inlineRadio1">W</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
        <label class="form-check-label" for="inlineRadio2">M</label>
      </div>
      <br>
      <br>

      <div class="form-group">
        <label for="tel">Telefonnummer:</label>
        <input type="text" class="form-control" id="registerPhone" placeholder="Telefonnummer" name="phone" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>


      <div class="form-group">
        <label for="pwd">E-Mail:</label>
        <input type="text" class="form-control" id="registerEmail" placeholder="E-Mail" name="email" required >
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>

      <div class="form-group">
        <label for="password1">Passwort:</label>
        <input type="password" class="form-control" id="registerPassword" placeholder="Passwort" name="password1" required
        onkeyup="validatePassword();">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
        <div class="passwordMessage">
            <label id="feedback"></label>
        </div>
      </div>
      <div class="form-group">
        <label for="password2">Passwort wiederholen:</label>
        <input type="password" class="form-control" id="loginPassword" placeholder="Passwort wiederholen" name="password2" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>


      <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
  </div>
</div>
<script src="assets/js/script1.js"></script>