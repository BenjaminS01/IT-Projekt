<div class="chooseTypeOfTraining ">
<div class="container ">
<h1 >Bitte wälen Sie einen Trainingstyp</h1>
 
    <form method="get"  class="needs-validation" novalidate>
      <div class="form-group">
      <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="chooseTimeAndRoom">
      <label style="margin-right:20px;"  for="tel">Trainingsart:</label>
      
      <?php
          if($this->_params['date']->format('N')!= 6 && $this->_params['date']->format('N') != 7) {
              include 'views/noWeekend.php';
          }
      ?>     

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="typeOfTraining" id="typeOfTraining2" value="Training"
        <?= isset($_GET['typeOfTraining']) ? ($_GET['typeOfTraining'] === 'Training' ? "checked" : '') : '' ?>>
        <label class="form-check-label" for="inlineRadio2">Einzeltraining</label>
      </div>
      <input type="hidden" id="trainingDate2" name="trainingDate" value="<?= $this->_params['trainingDate']?>">
      </div>
      <button type="submit"  class="btn btn-success">weiter</button>
    </form>
 
</div>
</div>
