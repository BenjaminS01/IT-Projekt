<div class="login">
  <div class="mx-auto">
    <form action="/action_page.php" class="needs-validation" novalidate>
      <div class="form-group">
        <label for="email">E-Mail:</label>
        <input type="text" class="form-control" id="loginEmail" placeholder="E-Mail" name="email" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group">
        <label for="pwd">Passwort:</label>
        <input type="password" class="form-control" id="loginPasswort" placeholder="Passwort" name="pswd" required>
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="remember" > Eingeloggt bleiben?
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
</div>