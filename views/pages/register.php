<div class="register">
  <div class="mx-auto">
    <h1>Registrierung</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=register'; ?>" >
      <div class="form-group">
        <label for="email">Vorname:</label>
        <input type="text" class="form-control" id="registerFirstName" placeholder="Vorname" name="firstName" 
        value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '' ?>">

      </div>
      <div class="form-group">
        <label for="password">Nachname:</label>
        <input type="text" class="form-control" id="registerLastname" placeholder="Nachname" name="lastName" 
        value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '' ?>">
      </div>

      <label for="tel">Anrede:</label>
      <br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="genderRadio" id="genderRadio1" value="Damen" required 
        <?= isset($_POST['genderRadio']) ? ($_POST['genderRadio'] === 'Damen' ? "checked" : '') : '' ?>>
        <label class="form-check-label" for="inlineRadio1">Frau</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="genderRadio" id="genderRadio2" value="Herren" required 
        <?= isset($_POST['genderRadio']) ? ($_POST['genderRadio'] === 'Herren' ? "checked" : '') : '' ?>>
        <label class="form-check-label" for="inlineRadio2">Herr</label>
      </div>
      <br>
      <br>

      <div class="form-group">
        <label for="phoneNumber">Telefonnummer:</label>
        <input type="text" class="form-control" id="registerPhone" placeholder="Telefonnummer" name="phoneNumber" 
        value="<?= isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : '' ?>">
      </div>


      <div class="form-group">
        <label for="pwd">E-Mail:</label>
        <input type="text" class="form-control" id="registerEmail" placeholder="E-Mail" name="email" required 
        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

      </div>

      <div class="form-group">
        <label for="password">Passwort:</label>
        <input type="password" class="form-control" id="registerPassword" placeholder="Passwort" name="password" required  
        onkeyup="validatePassword();">
        <div class="passwordMessage">
        <label id="feedback"></label>
        </div>
      </div>
      <div class="form-group">
        <label for="passwordCheck">Passwort wiederholen:</label>
        <input type="password" class="form-control" id="registerPasswordCheck" placeholder="Passwort wiederholen" name="passwordCheck" required  >
      </div>
      <br>
      <button type="submit" class="btn btn-success" name="submitRegister">Registrieren</button>
      <br>
      <br>
      <br>
    </form>
  </div>
</div>
<script src="assets/js/script1.js"></script>