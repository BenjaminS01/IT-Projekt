<div class="chooseTypeOfTraining">
  <div class="mx-auto">
    <form method="get"  class="needs-validation" novalidate>
      <div class="form-group">
      <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="chooseTimeAndRoom">
      <label for="tel">Trainingsart:</label>
      <br>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="typeOfTraining" id="typeOfTraining1" value="Kurs"
        <?= isset($_GET['typeOfTraining']) ? ($_GET['typeOfTraining'] === 'Kurs' ? "checked" : '') : '' ?>>
        <label class="form-check-label" for="inlineRadio1">Kurs</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="typeOfTraining" id="typeOfTraining2" value="Training"
        <?= isset($_GET['typeOfTraining']) ? ($_GET['typeOfTraining'] === 'Training' ? "checked" : '') : '' ?>>
        <label class="form-check-label" for="inlineRadio2">Einzeltraining</label>
      </div>
      <input type="hidden" id="trainingDate2" name="trainingDate" value="<?= $_GET['trainingDate']?>">
      </div>
      <button type="submit"  class="btn btn-primary">weiter</button>
    </form>
  </div>
</div>