<div class="register">
  <div class="mx-auto">
    <h1>Passwort ändern</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=editPassword'; ?>">

      <div class="form-group">
        <label for="password">Altes Passwort:</label>
        <input type="password" class="form-control"  placeholder="Passwort" name="password" required>
        
      </div>
      <div class="form-group">
        <label for="password">Neues Passwort:</label>
        <input type="password" class="form-control" id="newPassword" placeholder="Passwort" name="newPassword" required
          onkeyup="validatePassword();">
        <div class="passwordMessage">
            <label id="feedback2"></label>
        </div>
      </div>
      <div class="form-group">
        <label for="passwordCheck">Neues Passwort wiederholen:</label>
        <input type="password" class="form-control" id="registerPasswordCheck" placeholder="Passwort wiederholen" name="passwordCheck" required>
      </div>


      <button type="submit" class="btn btn-success" name="submitEdit">Änderung bestätigen</button>
    </form>
  </div>
</div>
<script src="assets/js/script1.js"></script>