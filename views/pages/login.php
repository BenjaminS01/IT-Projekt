<div class="login">
  <div class="mx-auto">
    <h1>Login</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=login'; ?>" >
      <div class="form-group">
        <label for="email">E-Mail:</label>
        <input type="text" class="form-control" id="loginEmail" placeholder="E-Mail" name="email" required>
      </div>
      <div class="form-group">
        <label for="pwd">Passwort:</label>
        <input type="password" class="form-control" id="loginPasswort" placeholder="Passwort" name="password" required>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name='stayLoggedIn' > Eingeloggt bleiben?
        </label>
      </div>
      <button type="submit" name="submitLogin" class="btn btn-success">Login</button>
    </form>
  </div>
</div>