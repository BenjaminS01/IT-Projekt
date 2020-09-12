<div class="register">
  <div class="mx-auto">
    <h1>Passwort ändern</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=editPassword'; ?>" class="needs-validation" novalidate>

      <div class="form-group">
        <label for="password">Altes Passwort:</label>
        <input type="password" class="form-control" id="registerPassword" placeholder="Passwort" name="password" required
        onkeyup="validatePassword();">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
        <div class="passwordMessage">
            <label id="feedback"></label>
        </div>
      </div>
      <div class="form-group">
        <label for="password">Neues Passwort:</label>
        <input type="password" class="form-control" id="registerPassword" placeholder="Passwort" name="newPassword" required
        onkeyup="validatePassword();">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
        <div class="passwordMessage">
            <label id="feedback"></label>
        </div>
      </div>
      <div class="form-group">
        <label for="passwordCheck">Neues Passwort wiederholen:</label>
        <input type="password" class="form-control" id="registerPasswordCheck" placeholder="Passwort wiederholen" name="passwordCheck" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>


      <button type="submit" class="btn btn-success" name="submitEdit">Änderung bestätigen</button>
    </form>
  </div>
</div>
<script src="assets/js/script1.js"></script>