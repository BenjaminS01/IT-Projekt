<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="typeOfTraining" id="typeOfTraining1" value="Kurs"
        <?= isset($_GET['typeOfTraining']) ? ($_GET['typeOfTraining'] === 'Kurs' ? "checked" : '') : '' ?>>
        <label class="form-check-label" for="inlineRadio1">Kurs</label>
      </div>