<div class="register">
  <div class="mx-auto">
    <form action="/action_page.php" class="needs-validation" novalidate>
      <div class="form-group">
        <label for="email">Vorname:</label>
        <input type="text" class="form-control" id="registerEmail" placeholder="E-Mail" name="email" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group">
        <label for="pwd">Nachname:</label>
        <input type="password" class="form-control" id="registerPasswort" placeholder="Passwort" name="pswd" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group">
        <label for="tel">Telefonnummer:</label>
        <input type="password" class="form-control" id="registerPhone" placeholder="Telefonnummer" name="tel" required>
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
      <button type="submit" class="btn btn-primary">Registrieren</button>
    </form>
  </div>
</div>