<div class="register">
  <div class="mx-auto">
    <h1>Persönliche Daten ändern</h1>
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=editPersonalData'; ?>" >
      <div class="form-group">
        <label for="email">Vorname:</label>
        <input type="text" class="form-control" id="registerFirstName"  name="firstName" required 
        value="<?= isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : htmlspecialchars($this->_params['member'][0]['firstName']) ?>">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group">
        <label for="password">Nachname:</label>
        <input type="text" class="form-control" id="registerLastname"  name="lastName" required 
        value="<?= isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : htmlspecialchars($this->_params['member'][0]['lastName']) ?>">
      
      </div>
      <div class="form-group">
        <label for="phoneNumber">Telefonnummer:</label>
        <input type="text" class="form-control" id="registerPhone"  name="phoneNumber" required
        value="<?= isset($_POST['phoneNumber']) ? htmlspecialchars($_POST['phoneNumber']) : htmlspecialchars($this->_params['member'][0]['phoneNumber']) ?>">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>
      <div class="form-group">
        <label for="pwd">E-Mail:</label>
        <input type="text" class="form-control" id="registerEmail"  name="email" required 
        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($this->_params['member'][0]['email'])?>">
        <div class="valid-feedback">Gültig</div>
        <div class="invalid-feedback">Bitte füllen Sie das Feld aus</div>
      </div>

      <button type="submit" class="btn btn-success" name="submitEdit">Änderung bestätigen</button>
    </form>
  </div>
</div>
<script src="assets/js/script1.js"></script>